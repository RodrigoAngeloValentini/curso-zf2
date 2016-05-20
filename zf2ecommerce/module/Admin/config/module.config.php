<?php

namespace Admin;

return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id]]',
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
    'service_manager' => array(
    	'factories' => array(
    		'admin-form-categoria' => 'Admin\Factory\Categoria',
    		'admin-form-usuario' => 'Admin\Factory\Usuario',
    		'admin-form-perfil' => 'Admin\Factory\Perfil',
    		'admin-form-produto' => 'Admin\Factory\Produto',
    		'admin-form-frete' => 'Admin\Factory\Frete',
    		'admin-form-atributo' => 'Admin\Factory\Atributo',
    	),
    	'invokables' => array(
    		// FILTERS
    		'admin-filter-categoria' => 'Admin\Filter\Categoria',
    		'admin-filter-usuario' => 'Admin\Filter\Usuario',
    		'admin-filter-perfil' => 'Admin\Filter\Perfil',
    		'admin-filter-resource' => 'Admin\Filter\Resource',
    		'admin-filter-atributo' => 'Admin\Filter\Atributo',
    		'admin-filter-atributo-tipo' => 'Admin\Filter\AtributoTipo',
    		'admin-filter-produto' => 'Admin\Filter\Produto',
    		'admin-filter-estoquelog' => 'Admin\Filter\EstoqueLog',
    		'admin-filter-pagamentostatus' => 'Admin\Filter\PagamentoStatus',
    		'admin-filter-pagamentotipo' => 'Admin\Filter\PagamentoTipo',
    		'admin-filter-transporte' => 'Admin\Filter\Transporte',
    		'admin-filter-frete' => 'Admin\Filter\Frete',
    		'admin-filter-caracteristica' => 'Admin\Filter\Caracteristica',
    		'admin-filter-caracteristica-perfil' => 'Admin\Filter\CaracteristicaPerfil',
    		'admin-filter-cupom' => 'Admin\Filter\Cupom',
    		// SERVICES
    		'admin-service-categoria' => 'Admin\Service\Categoria',
    		'admin-service-usuario' => 'Admin\Service\Usuario',
    		'admin-service-perfil' => 'Admin\Service\Perfil',
    		'admin-service-resource' => 'Admin\Service\Resource',
    		'admin-service-atributo' => 'Admin\Service\Atributo',
    		'admin-service-atributo-tipo' => 'Admin\Service\AtributoTipo',
    		'admin-service-produto' => 'Admin\Service\Produto',
    		'admin-service-estoquelog' => 'Admin\Service\EstoqueLog',
    		'admin-service-pagamentostatus' => 'Admin\Service\PagamentoStatus',
    		'admin-service-pagamentotipo' => 'Admin\Service\PagamentoTipo',
    		'admin-service-transporte' => 'Admin\Service\Transporte',
    		'admin-service-frete' => 'Admin\Service\Frete',
    		'admin-service-pedido' => 'Admin\Service\Pedido',
    		'admin-service-acl' => 'Admin\Service\Acl',
    		'admin-service-foto' => 'Admin\Service\Foto',
    		'admin-service-caracteristica' => 'Admin\Service\Caracteristica',
    		'admin-service-caracteristica-perfil' => 'Admin\Service\CaracteristicaPerfil',
    		'admin-service-cupom' => 'Admin\Service\Cupom',
    		// FORMS
    		'admin-form-resource' => 'Admin\Form\Resource',
    		'admin-form-atributo-tipo' => 'Admin\Form\AtributoTipo',
    		'admin-form-estoquelog' => 'Admin\Form\EstoqueLog',
    		'admin-form-pagamentostatus' => 'Admin\Form\PagamentoStatus',
    		'admin-form-pagamentotipo' => 'Admin\Form\PagamentoTipo',
    		'admin-form-transporte' => 'Admin\Form\Transporte',
    		'admin-form-caracteristica' => 'Admin\Form\Caracteristica',
    		'admin-form-caracteristica-perfil' => 'Admin\Form\CaracteristicaPerfil',
    		'admin-form-cupom' => 'Admin\Form\Cupom',
    	),
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
	'view_helpers' => array(
		'factories' => array(
			'uri' => function ($sm) {
				return new \Admin\View\Helper\Uri($sm->getServiceLocator()->get('application')->getRequest()->getQuery()->toArray());
			}
		),
		'invokables' => array(
			'preco' => 'Admin\View\Helper\Preco',
			'atributo' => 'Admin\View\Helper\Atributo',
			'estoque' => 'Admin\View\Helper\Estoque',
		),
	),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Categoria' => 'Admin\Controller\CategoriaController',
            'Admin\Controller\Usuario' => 'Admin\Controller\UsuarioController',
            'Admin\Controller\Perfil' => 'Admin\Controller\PerfilController',
            'Admin\Controller\Resource' => 'Admin\Controller\ResourceController',
            'Admin\Controller\Atributo' => 'Admin\Controller\AtributoController',
            'Admin\Controller\AtributoTipo' => 'Admin\Controller\AtributoTipoController',
            'Admin\Controller\Produto' => 'Admin\Controller\ProdutoController',
            'Admin\Controller\Estoque' => 'Admin\Controller\EstoqueController',
            'Admin\Controller\PagamentoStatus' => 'Admin\Controller\PagamentoStatusController',
            'Admin\Controller\PagamentoTipo' => 'Admin\Controller\PagamentoTipoController',
            'Admin\Controller\Transporte' => 'Admin\Controller\TransporteController',
            'Admin\Controller\Frete' => 'Admin\Controller\FreteController',
            'Admin\Controller\Pedido' => 'Admin\Controller\PedidoController',
            'Admin\Controller\Caracteristica' => 'Admin\Controller\CaracteristicaController',
            'Admin\Controller\CaracteristicaPerfil' => 'Admin\Controller\CaracteristicaPerfilController',
            'Admin\Controller\Cupom' => 'Admin\Controller\CupomController',
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
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/admin.phtml',
            'admin/index/index' 	  => __DIR__ . '/../view/admin/index/index.phtml',
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
