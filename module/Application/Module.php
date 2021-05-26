<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

/**
 * Class Module
 * @package Application
 */
class Module
{

    /**
     * Module constructor.
     */
    public function __construct()
    {
        error_reporting(0);
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'EntityManager' => function ($sm) {
                    $em = $sm->get('doctrine.entitymanager.orm_default');
                    return $em;
                },
                'Zend\Authentication\AuthenticationService' => function ($serviceManager) {
	                return $serviceManager->get('doctrine.authenticationservice.orm_default');
                },
            ),
        );
    }

	public function onBootstrap(MvcEvent $e) {
		$eventManager = $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);

		$eventManager->attach(MvcEvent::EVENT_DISPATCH, array(
			$this,
			'beforeDispatch',
		), 100);

		$eventManager->attach(MvcEvent::EVENT_DISPATCH, array(
			$this,
			'afterDispatch',
		), -100);
	}

	function beforeDispatch(MvcEvent $event)
	{
		$response = $event->getResponse();

		$whiteList = array(
			'Application\Controller\Auth-index',
		);

		$controller = $event->getRouteMatch()->getParam('controller');
		$action = $event->getRouteMatch()->getParam('action');
		$requestedResource = $controller . '-' . $action;

		$session = new Container('User');

		if ($controller == 'Application\Controller\Index') {
			if ($session->offsetExists('user')) {
			} else {
				if ($requestedResource != 'Application\Controller\Auth-index' && !in_array($requestedResource, $whiteList)) {
					$url = 'auth';
					$response->setHeaders($response->getHeaders()->addHeaderLine('Location', $url));
					$response->setStatusCode(302);
				}
				$response->sendHeaders();
			}
		}
	}

	function afterDispatch(MvcEvent $event)
	{

	}
}
