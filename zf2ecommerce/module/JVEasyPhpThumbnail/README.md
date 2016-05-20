JVEasyPhpThumbnail - JV Easy PHP Thumbnail
================
Create By: Jaime Marcelo Valasek

Use this module to generate thumbnail to apply the images on your website.

This module is using the library Easy Php Thumbniail, to know how to use the methods access the author's website - http://www.mywebmymail.com/?q=content/easyphpthumbnail-class

Futures video lessons poderam be developed and posted on the website or in http://www.zf2.com.br/tutoriais Youtube channel http://www.youtube.com/zf2tutoriais

Installation
-----
Download this module into your vendor folder.

After done the above steps, open the file config / application.config.php. And add the module with the name JVEasyPhpThumbnail.

Generating thumbnail in core and save it in the folder
-----
 - Use this code to generate the thumbnail when you're uploading the image.
 
```php
<?php

use JVEasyPhpThumbnail\Library\PHPThumb as EasyPhpThumbnail;

$phpThumb = new PHPThumb();
$phpThumb->Thumblocation = $_SERVER['DOCUMENT_ROOT'] . "/imagens/thumbs/";
$phpThumb->Chmodlevel = '0755';
$phpThumb->Thumbsaveas = 'jpg';
$phpThumb->Thumbsize = 300;
$phpThumb->Cropimage = array(2,0,40,40,50,50);

$destination = $_SERVER['DOCUMENT_ROOT'] . "/imagens/";
$nomeDoArquivo = 'minhaImagem.jpg';

$phpThumb->Createthumb($destination . '/' . $nomeDoArquivo, 'file');

```

Using the view helper to create thumbnails
-----

When using the view helper will be generated and stored in the thumbnail folder Imagecache

```php

// Controller code
$arrConfigure = array();
$arrConfigure['Thumbsize'] = 300;
$arrConfigure['Quality'] = 55;
$arrConfigure['Cropimage'] = array(2,0,40,40,50,50);

return new ViewModel(array(
    'arrConfigure' => $arrConfigure
));

// View Code
<img alt="nomedaimagem" src="<?php echo $this->phpthumb()->setImage('/conteudos/thumbs/', $nomedaimagem, $arrConfigure);?>">

```