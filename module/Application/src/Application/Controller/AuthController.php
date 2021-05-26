<?php

namespace Application\Controller;

use Application\Form\LoginForm;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;
use Zend\View\Model\ViewModel;

/**
 * Class AuthController
 * @package Application\Controller
 */
class AuthController extends AbstractActionController
{
    /**
     * @var null
     */
    private $_em = null;

    /**
     * @param \Zend\Stdlib\RequestInterface $request
     * @param \Zend\Stdlib\ResponseInterface|null $response
     * @return mixed|\Zend\Stdlib\ResponseInterface
     */
    public function dispatch(RequestInterface $request, ResponseInterface $response = null)
    {
        $this->_em = $this->getServiceLocator()->get('EntityManager');

        return parent::dispatch($request, $response);
    }

	/**
	 *
	 */
	private function template()
	{
		$this->layout('layout/login');
	}


	/**
	 * @return ViewModel
	 */
	public function indexAction()
	{
		$this->template();
		$form = new LoginForm();
		$request = $this->getRequest();

		if ($request->isPost()) {
			$data = $request->getPost();

			$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

			$adapter = $authService->getAdapter();
			$adapter->setIdentity($data['name']);
			$adapter->setCredential($data['password']);
			$authResult = $authService->authenticate();
			if ($authResult->isValid()) {
				$session = new Container('User');
				$session->offsetSet('user', $data['name']);
				$this->redirect()->toRoute('app');
			}
		}

		return new ViewModel(array(
			'form' => $form,
		));
	}

	/**
	 * @return \Zend\Http\Response
	 */
	public function logoutAction() {
		$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		$authService->clearIdentity();

		$session = new Container('User');
		$session->getManager()->getStorage()->clear('User');

		return $this->redirect()->toRoute('app');
	}
}