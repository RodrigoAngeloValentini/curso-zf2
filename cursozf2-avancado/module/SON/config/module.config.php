<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SON;

return array(
    'router' => array(
        'routes' => array(
            'son-home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/son/',
                    'defaults' => array(
                        'controller' => 'SON\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
//            'son-regex' => array(
//                'type' => 'regex',
//                'options' => array(
//                    'regex' => '/son/artigo/(?P<id>\d+)',
//                    'spec' => '/son/artigo/%id%',
//                    'defaults' => array(
//                        'controller' => 'SON\Controller\Index',
//                        'action' => 'artigo',
//                    ),
//                ),
//            ),
//            'son-wildcard' => array(
//                'type' => 'wildcard',
//                'options' => array(
//                    'route' => '/son/artigo/',
//                    'key_value_delimiter' => '-',
//                    'param_delimiter' => '/',
//                    'defaults' => array(
//                        'controller' => 'SON\Controller\Index',
//                        'action' => 'artigo',
//                    )
//                )
//            )
//            'son-segment' => array(
//                'type' => 'segment',
//                'options' => array(
//                    'route' => '/son/artigo[/:id]',
//                    'constraints' => array('id'=>'\d+'),
//                    'defaults' => array(
//                        'controller' => 'SON\Controller\Index',
//                        'action' => 'artigo',
//                    )
//                )
//            )
//  type=>hostname
//  :usuario.users.site.com            
//
// type=>scheme
//  options-> 'scheme'=>'https'     
//
// type=method
//  options-> verb=>'post,put'            

            'son-treeroute' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/son/artigo',
                    'defaults' => array(
                        'controller' => 'SON\Controller\Index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'artigo' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:id',
                            'constraints' => array('id'=>'\d+'),
                            'defaults' => array('action'=>'artigo')
                            
                        )
                    )
                )
            )
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../languageGettext',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'SON\Controller\Index' => 'SON\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'son/index/index' => __DIR__ . '/../view/son/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
);
