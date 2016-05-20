<?php

namespace JVEasyPhpThumbnail\View\Helper;

use JVEasyPhpThumbnail\Service\PHPThumb as EasyPhpThumbnail;
use Zend\View\Helper\AbstractHelper;

class PHPThumb extends AbstractHelper
{
    /**
     * @param string $destination
     * @param string $imageName
     */
	public function setImage($destination, $imageName, $configure = array())
	{
	    $root = $_SERVER['DOCUMENT_ROOT'];
	    
        // instanciando a classe thumb
	    $phpThumb = new EasyPhpThumbnail();
	    $phpThumb->imageName = $imageName;
	    	    
	    // atribui as configurações
	    if (count($configure))
	    {
	        foreach ($configure as $method => $value)
	        {
	            $phpThumb->$method = $value;
	        }
	    }

	    $phpThumb->Createthumb($root . $destination . $imageName);
	}
	
	
    
    /* public function __invoke()
    {
        $phpThumb = new EasyPhpThumbnail();
        $phpThumb->Createthumb($this->image);
        
        echo "<pre>";
        exit(print_r($phpThumb));
        echo "</pre>";
        
        if (count($this->configure))
        {
            foreach ($this->configure as $method => $value)
            {
                $phpThumb->$method = $value;
            }
        }
        
        return array(
            'menu' => $categoriaService->montaMenuApp()
        );
    } */
}