JVUpload - JV Upload
================
Create By: Jaime Marcelo Valasek

Use this module to upload files.

Futures video lessons can be developed and published on the website or Youtube channel http://www.zf2.com.br/tutoriais - http://www.youtube.com/zf2tutoriais

Installation
-----
Download this module into your vendor folder.

After done the above steps, open the file `config/application.config.php`. And add the module with the name `JVUpload`.

### Pendencies modules
 
 - To use the module you must also install the following modules:
 
JVConfig - https://github.com/jaimevalasek/JVConfig
JVEasyPhpThumbnail - https://github.com/jaimevalasek/JVEasyPhpThumbnail
JVMimeTypes - https://github.com/jaimevalasek/JVMimeTypes

### With composer

1. Add this project and JVEasyPhpThumbnail + JVMimeTypes + JVConfig in your composer.json:

```php
"require": {
    "jaimevalasek/jv-upload": "dev-master"
}
```

2. Now tell composer to download JVUpload by running the command:

```php php composer.phar update```

### Post installation

1.Enabling it in your `application.config.php`.

```php
<?php
return array(
    'modules' => array(
        // ...
        'JVConfig',
        'JVEasyPhpThumbnail',
        'JVMimeTypes',
        'JVUpload',
    ),
    // ...
);
```

2. Configure the array configuration module JVConfig or in your main module

```php
<?php
return array(
	// ...
	'jv-upload' => array(
	    'types' => array(
	        'image', 'audio', 'video', 'app', 'thumb', 'text', 'file', 'custom'
	    ),
	),
	// ...
);
```

Using the JVUpload
-----

### Basic image example

```php
$upload = new \JVUpload\Service\Upload($this->getServiceLocator()->get('servicemanager'));
$upload->setType('image')
    ->setThumb(array('destination' => '/conteudos/thumbs', 'width' => 200, 'height' => 250, 'cropimage' => array(2,0,40,40,50,50)))
    ->setExtValidation('ext-image-min')
    ->setSizeValidation(array('18', '200')) // validation of the file size in KB array (min max).
    ->setDestination('/conteudos/imagens')
    ->prepare()->execute();
```