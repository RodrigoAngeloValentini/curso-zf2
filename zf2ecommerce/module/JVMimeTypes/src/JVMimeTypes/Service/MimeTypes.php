<?php

namespace JVMimeTypes\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

class MimeTypes
{
    protected $sm;
    protected $config;
    
    public function __construct(ServiceLocatorInterface $sm)
    {
        $this->sm = $sm;
        $this->config = $this->sm->get('config');
    }
    
    public function getAll()
    {
        return $this->config['mime_types'];
    }
    
    public function getAllCustom()
    {
        return $this->config['mime_types_custom'];
    }
    
    public function getExtAll()
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $return[] = $indice;
        }
        
        return $return;
    }
    
    public function getPairsMimeTypeToExt()
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $return[$valor] = $indice;
        }
        
        return $return;
    }
    
    public function getMimeTypeAll($indiceToEx8t = true)
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            ($indiceToExt) ? $return[$indice] = $valor : $return[] = $valor;
        }
    
        return $return;
    }
    
    public function getExtImage()
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $pos = strpos($valor, 'image/');
            if ($pos !== false) {
                $return[] = $indice;
            }
        }
        
        return $return;
    }
    
    public function getMimeTypeImage($indiceToEx8t = true)
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $pos = strpos($valor, 'image/');
            if ($pos !== false) {
                ($indiceToExt) ? $return[$indice] = $valor : $return[] = $valor;
            }
        }
        
        return $return;
    }
    
    public function getExtVideo()
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $pos = strpos($valor, 'video/');
            if ($pos !== false) {
                $return[] = $indice;
            }
        }
        
        return $return;
    }
    
    public function getMimeTypeVideo($indiceToExt = true)
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $pos = strpos($valor, 'video/');
            if ($pos !== false) {
                ($indiceToExt) ? $return[$indice] = $valor : $return[] = $valor;
            }
        }
        
        return $return;
    }
    
    public function getExtAudio()
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $pos = strpos($valor, 'audio/');
            if ($pos !== false) {
                $return[] = $indice;
            }
        }
        
        return $return;
    }
    
    public function getMimeTypeAudio($indiceToExt = true)
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $pos = strpos($valor, 'audio/');
            if ($pos !== false) {
                ($indiceToExt) ? $return[$indice] = $valor : $return[] = $valor;
            }
        }
        
        return $return;
    }
    
    public function getExtApplication()
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $pos = strpos($valor, 'application/');
            if ($pos !== false) {
                $return[] = $indice;
            }
        }
        
        return $return;
    }
    
    public function getMimeTypeApplication($indiceToExt = true)
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $pos = strpos($valor, 'application/');
            if ($pos !== false) {
                ($indiceToExt) ? $return[$indice] = $valor : $return[] = $valor;
            }
        }
        
        return $return;
    }
    
    public function getExtText()
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $pos = strpos($valor, 'text/');
            if ($pos !== false) {
                $return[] = $indice;
            }
        }
        
        return $return;
    }
    
    /**
     * @param string $indiceToExt (opicional valor padrão true)
     * @return array mime types files
     */
    public function getMimeTypeText($indiceToExt = true)
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $pos = strpos($valor, 'text/');
            if ($pos !== false) {
                ($indiceToExt) ? $return[$indice] = $valor : $return[] = $valor;
            }
        }
        
        return $return;
    }
    
    /**
     * @return array mime types files
     */
    public function getExtFiles()
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            $return[] = $indice;
        }
    
        return $return;
    }
    
    /**
     * @param string $indiceToExt (opicional valor padrão true)
     * @return array mime types files
     */
    public function getMimeTypeFiles($indiceToExt = true)
    {
        $mimeTypes = $this->config['mime_types'];
        foreach ($mimeTypes as $indice => $valor)
        {
            ($indiceToExt) ? $return[$indice] = $valor : $return[] = $valor;
        }
    
        return $return;
    }
    
    /**
     * @param array $types (Passar os perfis das configurações custom dos mime types que estão no arquivo module.config.php)
     */
    public function getExtCustom(array $types)
    {
        // definindo o array de return
        $return = array();
        
        // pegando os mime_types_custom
        $mimeTypes = $this->config['mime_types_custom'];
        foreach ($mimeTypes as $indice => $valor)
        {
            if (in_array($indice, $types))
                $return = array_merge($valor, $return);
        }
    
        return $return;
    }
    
    /**
     * @param array $types (Passar os perfis das configurações custom dos mime types que estão no arquivo module.config.php)
     * @param string $indiceToExt (opicional valor padrão true)
     */
    public function getMimeTypeCustom(array $types, $indiceToExt = true)
    {
        // definindo o array de return
        $return = array();
        
        $mimeTypes = $this->config['mime_types'];
        
        $mimeTypesCustom = $this->config['mime_types_custom'];
        
        foreach ($mimeTypesCustom as $indice => $valor)
        {
            if (in_array($indice, $types)) 
            {
                foreach ($valor as $ext) {
                    ($indiceToExt) ? $return[$ext] = $mimeTypes[$ext] : $return[] = $mimeTypes[$ext];
                }
            }
        }
    
        return $return;
    }
}