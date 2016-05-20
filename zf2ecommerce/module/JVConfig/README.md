JVConfig - JV Config
================
Create By: Jaime Marcelo Valasek

Use this module to generate the configurations of the modules jaimevalasek/JV.*

Futures video lessons can be developed and published on the website or Youtube channel http://www.zf2.com.br/tutoriais http://www.youtube.com/zf2tutoriais

Installation
-----
Download this module into your vendor folder.
 - Also install the module JVConfig - https://github.com/jaimevalasek/JVConfig. 

After done the above steps, open the file `config/application.config.php`. And add the module with the name JVConfig.

### With composer

1. Edit composer.json

```php
"require": {
    "jaimevalasek/jv-config": "dev-master"
}
```

2. Now tell composer to download JVConfig by running the command:

```php
php composer.phar update
```

### Post installation

```php
<?php
return array(
    'modules' => array(
        // ...
        'JVConfig',
    ),
    // ...
);
```

Using the JVConfig
-----

### The settings of all modules jaimevalasek/JV.* Poderam all be centralized within this module to facilitate additions, changes, etc..
```php
// config/module.config.php
return array(
	// ...
	The settings of the modules go here
	// ...
);
```