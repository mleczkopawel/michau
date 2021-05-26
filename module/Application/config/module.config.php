<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'app' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/app',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
            'save' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/save/:option',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'save',
                    ),
                ),
            ),
            'plants' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/plants',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'plants',
                    ),
                ),
            ),
            'fertilizers' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/fertilizers',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'fertilizers',
                    ),
                ),
            ),
            'surfaces' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/surfaces',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'surfaces',
                    ),
                ),
            ),
            'areas' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/areas',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'areas',
                    ),
                ),
            ),
            'measurments' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/measurments',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'measurments',
                    ),
                ),
            ),
            'auth' => array(
	            'type' => 'Literal',
	            'options' => array(
		            'route' => '/auth',
		            'defaults' => array(
			            'controller' => 'Application\Controller\Auth',
			            'action' => 'index',
		            ),
	            ),
	            'may_terminate' => true,
	            'child_routes' => array(
		            'logout' => array(
			            'type' => 'Literal',
			            'options' => array(
				            'route' => '/logout',
				            'defaults' => array(
					            'controller' => 'Application\Controller\Auth',
					            'action' => 'logout',
				            ),
			            ),
		            ),
	            ),
            ),
        ),
    ),
    'doctrine' => array(
	    'authentication' => array(
		    'orm_default' => array(
			    'object_manager' => 'Doctrine\ORM\EntityManager',
			    'identity_class' => 'Application\Entity\User',
			    'identity_property' => 'name',
			    'credential_property' => 'password',
		    ),
	    ),
        'driver' => [
            'default_driver' => [
                'class' => AnnotationDriver::class,
                'paths' => [
                    __DIR__ . '/../src/Application/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Application\Entity' => 'default_driver',
                ],
            ],
        ],
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => ROOT_PATH . '/module/language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
	        'Application\Controller\Auth' => 'Application\Controller\AuthController',
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
	        'login/layout' => __DIR__ . '/../view/layout/login.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'layout' => 'layout/layout',
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(),
        ),
    ),
);
