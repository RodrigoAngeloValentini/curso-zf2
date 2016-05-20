<?php
/**
 * 
 * @author Jaime Marcelo Valasek
 * @category Upload
 * @license MIT
 * @package JVUpload
 *
 */

namespace JVUpload\Service;

use Zend\ServiceManager\ServiceLocatorInterface,
    JVMimeTypes\Service\MimeTypes,
    Zend\Config\Config;

abstract class AbstractUpload implements UploadInterface
{
    protected $path;
    protected $separator = false;
    protected $sm;
    protected $configMimeTypes;
    protected $configMimeTypesCustom;
    protected $rename;
    protected $nameToSlug;
    protected $type;
    protected $sizeValidation;
    protected $extValidation;
    protected $destination;
    protected $thumbOpt = array();
    protected $exceptCode = 3;
    protected $required = false;
    
    /**
     * Construtor que seta o a variável sm e path
     *  
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function __construct(ServiceLocatorInterface $serviceLocator) {
        $request = $serviceLocator->get('request');
        $this->sm = $serviceLocator;
        $this->path = $request->getServer('DOCUMENT_ROOT');
    }
    
    /**
     * Retorna o service de serviceLocator
     * 
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return $this->sm;
    }
    
    /**
     * Retorna o config do serviceLocator
     * 
     * @return array
     */
    public function getConfig() {
        return $this->getServiceLocator()->get('config');
    }
    
    /**
     * Retorna uma lista de array contendo todos os mime types
     *  
     * @return array
     */
    public function getConfigMimeTypes()
    {
        if ($this->configMimeTypes === null) {
            $this->configMimeTypes = $this->getMimeTypes()->getAll();
        }
        
        return $this->configMimeTypes;
    }
    
    /**
     * Retorna uma lista de array de mime types custom
     * 
     * @return array
     */
    public function getConfigMimeTypesCustom()
    {
        if ($this->configMimeTypes === null) {
            $this->configMimeTypesCustom = $this->getMimeTypes()->getAllCustom();
        }
        
        return $this->configMimeTypesCustom;
    }
    
    /**
     * Retorna todos os metodos de mime types do modulo JVMimeTypes
     * 
     * @return \JVMimeTypes\Service\MimeTypes
     */
    public function getMimeTypes() {
        return new MimeTypes($this->getServiceLocator()->get('servicemanager'));
    }
    
    /**
     * @param string|array $rename
     * @return $this
     */
    public function setRename($rename = true) {
        $this->rename = $rename;
        
        return $this;
    }
    
    /**
     * @param string $separator
     * @return $this
     */
    public function setNameToSlug($separator = '_')
    {
        $this->separator = $separator;
        
        return $this;
    }
    
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $config = $this->getConfig();
        
        if (!in_array($type, $config['jv-upload']['types'])) {
            throw new \InvalidArgumentException("O type do arquivo passado '{$type}' não existe no arquivo de configuração.", $this->exceptCode);
        }
        
        $this->type = $type;
        
        return $this;
    }
    
    /**
     * @param array $sizeValidation forAll: array(min, max) | forEach: array('file1' => array(min, max), 'file2' => array(min, max))     
     * @return $this
     */
    public function setSizeValidation(array $sizeValidation)
    {
        if (is_string(key($sizeValidation))) 
        {
            $this->sizeValidation = array();
            foreach ($sizeValidation as $id => $content)
            {
                if (!is_array($content) && count($content) != 2) {
                    throw new \InvalidArgumentException('Os parâmetros passados no setSizeValidation estão incorretos, você precisa passar um array com o valor mínimo e máximo em KB, ex.: array("100", "1024")', $this->exceptCode);
                }
                
                if ($content[0] >= $content[1])
                {
                    throw new \InvalidArgumentException('O tamanho mínimo deve ser menor que o tamanho máximo, o primeiro parâmetro corresponde ao tamanho mínimo.', $this->exceptCode);
                }
                
                // convertendo bytes em kbytes
                foreach ($content as $indice => $item)
                    $content[$indice] = $item * 1024;
                
                $this->sizeValidation[$id] = $content;
            }
        }
        else
        {
            if (!is_array($sizeValidation) && count($sizeValidation) != 2) {
                throw new \InvalidArgumentException('Os parâmetros passados no setSizeValidation estão incorretos, você precisa passar um array com o valor mínimo e máximo em KB, ex.: array("100", "1024")', $this->exceptCode);
            }
            
            if ($sizeValidation[0] >= $sizeValidation[1])
            {
                throw new \InvalidArgumentException('O tamanho mínimo deve ser menor que o tamanho máximo, o primeiro parâmetro corresponde ao tamanho mínimo.', $this->exceptCode);
            }
            
            // convertendo bytes em kbytes
            foreach ($sizeValidation as $indice => $item)
                $sizeValidation[$indice] = $item * 1024;
            
            $this->sizeValidation = $sizeValidation;
        }
        
        return $this;
    }
    
    /**
     * @param string|array $extValidation forAll: array('perfilext') | forEach: array('file1' => 'perfilext1', 'file2' => 'perfilext2')
     * @return $this
     */
    public function setExtValidation($extValidation)
    {
        $config = $this->getConfigMimeTypesCustom();
        
        if (is_array($extValidation)) 
        {
            $this->extValidation = array();
            foreach ($extValidation as $file => $content)
            {
                if (!isset($config[$content]))
                {
                    throw new \InvalidArgumentException("O perfil de extensões '{$content}' não existe no arquivo de configuração.", $this->exceptCode);
                }
                
                $this->extValidation[$file] = $config[$content];
            }
        }
        else 
        {
            if (!isset($config[$extValidation]))
            {
                throw new \InvalidArgumentException("O perfil de extensões '{$extValidation}' não existe no arquivo de configuração.", $this->exceptCode);
            }
            
            $this->extValidation = $config[$extValidation];
        }
        
        return $this;
    }
    
    /**
     * Define o destino do upload do arquivo
     * 
     * @param string $destination
     * @return $this;
     */
    public function setDestination($destination) {
        $this->destination = $destination;
        
        return $this;
    }
    
    /**
     * Gera thumb em caso de upload de imagem
     * 
     * @param array $thumbOpt array(destination, width, height, cropimage)
     * 
     * @return $this
     */
    public function setThumb(array $thumbOpt) {
        $this->thumbOpt = count($thumbOpt) ? $thumbOpt : array();
        
        return $this;
    }
    
    /**
     * Padrão é a pasta root publica do seu site
     * Use o setPath se quiser setar outro local que não seja o root do seu site
     * 
     * @param string $path
     * @return $this
     */
    public function setPath($path) {
        $this->path = $path;
        
        return $this;
    }
    
    /**
     * Passar o nome das opções dentro de um array, opções disponíveis são array('required')
     * 
     * @param array $options
     * @return $this;
     */
    public function setOptions(array $options)
    {
        if (count($options)) 
        {
            foreach ($options as $opt) {
                if ($opt == 'required')
                    $this->required = true;
            }
        }
        
        return $this;
    }
    
    /**
     * Prepara e valida os tipos para exibir os valores padrões
     */
    public function prepareTypes()
    {
        $config = $this->getConfigMimeTypesCustom();
        
        if ($this->type == 'thumb' && $this->extValidation === null) {
            $this->extValidation = $config['ext-image-thumb'];
        }
        
        switch ($this->type)
        {
            case 'audio':
                if ($this->extValidation === null)
                    $this->extValidation = $this->getMimeTypes()->getExtAudio();
                break;
            case 'image':
                if ($this->extValidation === null)
                    $this->extValidation = $this->getMimeTypes()->getExtImage();
                break;
            case 'file':
                if ($this->extValidation === null)
                    $this->extValidation = $this->getMimeTypes()->getExtFiles();
                break;
            case 'app':
                if ($this->extValidation === null)
                    $this->extValidation = $this->getMimeTypes()->getExtApplication();
                break;
            case 'text':
                if ($this->extValidation === null)
                    $this->extValidation = $this->getMimeTypes()->getExtText();
                break;
            case 'video':
                if ($this->extValidation === null)
                    $this->extValidation = $this->getMimeTypes()->getExtFiles();
                break;
            default:
                if ($this->extValidation === null)
                    $this->extValidation = $this->getMimeTypes()->getExtAll();
                break;
        }
        
        // se o tipo for image pode gerar também a thumb se estiver setado
        if ($this->type != 'image') {
            $this->setThumb(array());
        }
    }
}