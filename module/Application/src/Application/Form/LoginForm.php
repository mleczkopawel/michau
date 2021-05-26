<?php

namespace Application\Form;

use Zend\Form\Form;

/**
 * Class LoginForm
 * @package Application\Form
 */
class LoginForm extends Form
{

	/**
	 * CreateUserForm constructor.
	 * @param null $name
	 */
	public function __construct($name = null)
	{
		parent::__construct($name = 'createUser');
		$this->setAttribute('method', 'post');

		$this->add(array(
			'name' => 'name',
			'type' => 'text',
			'options' => array(
				'label' => 'Nazwa Użytkonika',
			),
			'attributes' => array(
				'class' => 'form-control',
				'required' => true,
			),
		));

		$this->add(array(
			'name' => 'password',
			'type' => 'password',
			'options' => array(
				'label' => 'Hasło admina',
			),
			'attributes' => array(
				'class' => 'form-control',
				'required' => true,
			),
		));

		$this->add(array(
			'name' => 'createSubmit',
			'type' => 'submit',
			'attributes' => array(
				'value' => 'Zaloguj',
				'class' => 'btn btn-primary btn-block',
				'style' => 'margin-top: 2%',
			)
		));
	}
}