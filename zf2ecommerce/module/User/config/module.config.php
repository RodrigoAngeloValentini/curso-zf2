<?php

namespace User;

use Zend\Crypt\Password\Bcrypt;

return array(
    'router' => array(
        'routes' => array(
        	'logout' => array(
        		'type' => 'Zend\Mvc\Router\Http\Literal',
        		'options' => array(
        			'route'    => '/logout',
        			'defaults' => array(
        				'controller' => 'User\Controller\Login',
        				'action'     => 'logout',
        			),
        		),
        	),
        	'dados_pessoais' => array(
        		'type' => 'Zend\Mvc\Router\Http\Literal',
        		'options' => array(
        			'route'    => '/dados-pessoais',
        			'defaults' => array(
        				'controller' => 'User\Controller\Index',
        				'action'     => 'dadosPessoais',
        			),
        		),
        	),
        	'alterar_dados' => array(
        		'type' => 'Zend\Mvc\Router\Http\Literal',
        		'options' => array(
        			'route'    => '/alterar-dados',
        			'defaults' => array(
        				'controller' => 'User\Controller\Index',
        				'action'     => 'alterarDados',
        			),
        		),
        	),
            'user' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
	'view_helpers' => array(
		'invokables' => array(
			'useridentity' => 'User\View\Helper\UserIdentity'
		),
	),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
    	'invokables' => array(
    		'user-service-usuario' => 'User\Service\Usuario',
    		'user-service-acl' => 'User\Service\Acl',
    		'user-service-auth' => 'User\Service\Auth'
    	),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'User\Controller\Index' => 'User\Controller\IndexController',
            'User\Controller\Cadastrar' => 'User\Controller\CadastrarController',
            'User\Controller\Login' => 'User\Controller\LoginController',
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
    	'authentication' => array(
    		'orm_default' => array(
    			'object_manager' => 'Doctrine\ORM\EntityManager',
    			'identity_class' => 'Admin\Entity\Usuario',
    			'identity_property' => 'email',
    			'credential_property' => 'senha',
    			'credential_callable' => function(\Admin\Entity\Usuario $usuario, $senha) {
    				if ($usuario->getStatus() == 0) {
    					return false;
    				}
    				
    				$bcrypt = new Bcrypt();
    				$bcrypt->setCost('14');
    				
    				return $bcrypt->verify($senha, $usuario->getSenha());
    			}
    		)
    	)
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
