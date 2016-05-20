<?php

namespace JVUpload\Service;

interface UploadInterface
{
    public function getServiceLocator();
    public function getConfig();
    public function getConfigMimeTypes();
    public function getConfigMimeTypesCustom();
    public function getMimeTypes();
    public function setRename($rename = null);
    public function setNameToSlug($separator);
    public function setType($type);
    public function setThumb(array $thumbOpt);
    public function setSizeValidation(array $sizeValidation);
    public function setExtValidation($extValidation);
    public function setDestination($destination);
    public function setPath($path);
    public function setOptions(array $options);
    
    public function prepareTypes();
}