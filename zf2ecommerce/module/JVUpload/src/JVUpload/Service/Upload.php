<?php

namespace JVUpload\Service;

use JVEasyPhpThumbnail\Service\PHPThumb;

use Zend\Validator\File\Extension;

use Zend\Validator\File\Size;

use Zend\File\Transfer\Adapter\Http;

class Upload extends AbstractUpload
{
    /**
     * Prepara as configurações do upload
     * 
     * @return \JVUpload\Service\Upload
     */
    public function prepare()
    {
        // Organizando e preparando os tipos
        $this->prepareTypes();
        
        // verifica se o tipo de envio é imagem e se precisa gerar miniatura
        if ($this->thumbOpt !== null && $this->type != 'image')
            $this->setThumb(array());
        
        return $this;
    }
    
    /**
     * @param Http $file
     * @return \JVUpload\Service\Upload
     */
    private function generateThumbs(Http $file)
    {
        $fileInfo = $file->getFileInfo();
        
        foreach ($fileInfo as $id => $item)
        {
            // destino do arquivo
            $file->setDestination($this->thumbOpt, $id);
            
        }
        
        return $this;
    } 
    
    public function execute()
    {
        $file = new Http();
        
        $fileInfo = $file->getFileInfo();
        
        // armazena os caminhos dos arquivos que fizeram upload para remover em caso de erros
        $tempDirUpload = array();
        
        // retorno com o nome do arquivo enviados
        $return = array();
        
        foreach ($fileInfo as $id => $item)
        {
            // se for um array renomeia separadamente os arquivos
            if (is_array($this->rename))
            {
                if (array_key_exists($id, $this->rename))
                {
                    $newName = $this->rename[$id] . "." . substr(strrchr($item['name'],'.'), 1);
                    $file->setFilters(array('Rename' => $newName), $id);
                }
            } 
            // se retornar true renomeia o arquivo com um hash
            elseif ($this->rename)
            {
                $newName = md5(microtime()) . "." . substr(strrchr($item['name'],'.'), 1);
                $file->setFilters(array('Rename' => $newName));
            // se for null fica a imagem com o nome normal
            } else {
                $newName = $item['name'];
            }
            
            // destino do arquivo
            $destination = is_array($this->destination) ? $this->path . $this->destination[$id] : $this->path . $this->destination;
            if (!is_dir($destination))
                mkdir($destination);
            chmod($destination, "0775");
            $file->setDestination($destination, $id);
            
            // validações
            $arrValidators = array();
            
            // verifica se tem validação de tamanho se tiver aplica
            if ($this->sizeValidation !== null)
            {
                $size = isset($this->sizeValidation[$id]) ? $this->sizeValidation[$id] : $this->sizeValidation;
                $sizeValidation = new Size(array('min' => $size[0], 'max' => $size[1]));
                $arrValidators[] = $sizeValidation;
            }
            
            // verifica se tem validação de extensão se tiver aplica
            if ($this->extValidation !== null)
            {
                $ext = isset($this->extValidation[$id]) ? $this->extValidation[$id] : $this->extValidation;
                $extValidation = new Extension($ext);
                $arrValidators[] = $extValidation;
            }

            // setando as validações caso existam
            if (count($arrValidators)) {
                $file->setValidators($arrValidators, $id);
            }
            
            // valida o arquivo
            if ($file->isValid($id)) 
            {
                // envia o arquivo
                if ($file->receive($id))
                {
                    // seta o destino do arquivo
                    $tempDirUpload[] = $destination . "/" . $newName;
                    
                    // seta o nome do arquivo
                    $return['files'][$id] = $newName;
                    
                    // verifica se tem destino thumb se tiver gera a thumb
                    if (count($this->thumbOpt))
                    {
                        // setando os opções obrigatórias
                        $arrThumbOptRequire = array('destination' => 'destination', 'width' => 'width', 'height' => 'height', 'cropimage' => 'cropimage');
                        
                        // Validando se todos os parâmetros foram passados
                        foreach ($this->thumbOpt as $thumbIndex => $thumbValue)
                            unset($arrThumbOptRequire[$thumbIndex]);
                        
                        if (count($arrThumbOptRequire)) {
                            throw new \Exception('Configure corretamente o setThumb("destination", "width", "height", "cropimage")');
                        }
                        
                        /*
                         * Criando a thumb usando o modulo JVEasyPhpThumbnail
                        */
                        $destinationThumb = $this->path . $this->thumbOpt['destination'] . "/";
                        if (!is_dir($destinationThumb))
                        	mkdir($destinationThumb);
                        chmod($destinationThumb, "0775");
                        
                        $phpThumb = new PHPThumb();
                        $phpThumb->Thumblocation = $destinationThumb;
                        $phpThumb->Chmodlevel = '0755';
                        $phpThumb->Thumbsaveas = substr(strrchr($item['name'],'.'), 1);
                        $phpThumb->Thumbwidth = $this->thumbOpt['width'];
                        $phpThumb->Thumbheight = $this->thumbOpt['height'];
                        $phpThumb->Cropimage = $this->thumbOpt['cropimage'];
                        
                        $destination = $destination . "/" . $newName;
                        $phpThumb->Createthumb($destination, 'file');
                    }
                } 
            } else {
                $keyError = $file->getErrors();
                
                // verifica se fez algum upload se tiver exclui os arquivos, mas caso o required esteja setado como true
                if (count($tempDirUpload) && ($this->required && in_array('fileUploadErrorNoFile', $keyError)) || (!in_array('fileUploadErrorNoFile', $keyError)))
                {
                    foreach ($tempDirUpload as $filename)
                        unlink($filename);
                }
                
                if (($this->required && in_array('fileUploadErrorNoFile', $keyError)) || (!in_array('fileUploadErrorNoFile', $keyError)))
                    return array('error' => array($id => $file->getMessages()));
            }
        }
        
        return $return;
    }
}