<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class SignupForm extends Form
{
	
	public function __construct($name = null)
	{
		parent::__construct('usersignup');
		$this->setAttribute('method', 'post');
		$this->addFields();
	}

	public function addFields()
	{
		$this->add([
			'name' => 'firstname',
			'type' => Element\Text::class,
			'options' => [
				'label' => 'First Name',
				'label_attributes' => [
					'class' => 'control-label'
				],
			],
            'attributes' => [
                'class'  => 'firstname',
			],			
		]);

		$this->add([
			'name' => 'lastname',
			'type' => Element\Text::class,
			'options' => [
				'label' => 'Last Name',
				'label_attributes' => [
					'class' => 'control-label',
				],
			],
			'attributes' => [
				'class' => 'lastname',
			],
		]);

		$this->add([
			'name' => 'policynumber',
			'type' => Element\Text::class,
			'options' => [
				'label' => 'Policy Number',
				'label_attributes' => [
					'class' => 'control-label',
				],
			],
			'attributes' => [
				'class' => 'policynumber',
			],
		]);

		$this->add([
			'name' => 'startdate',
			'type' => Element\Date::class,
			'options' => [
				'label' => 'Start Date',
				'label_attributes' => [
					'class' => 'control-label',
				],
			],
			'attributes' => [
				'class' => 'startdate',
			],
		]);

		$this->add([
			'name' => 'enddate',
			'type' => Element\Date::class,
			'options' => [
				'label' => 'End Date',
				'label_attributes' => [
					'class' => 'control-label',
				],
			],
			'attributes' => [
				'class' => 'enddate',
			],
		]);

		$this->add([
			'name' => 'premium',
			'type' => Element\Text::class,
			'options' => [
				'label' => 'Premium',
				'label_attributes' => [
					'class' => 'control-label',
				],
			],
			'attributes' => [
				'class' => 'premium',
			],
		]);
		
		$this->add(new Element\Csrf('csrf'));

		$this->add([
            'name' => 'signup',
            'attributes' => [
                'type'  => 'submit',
                'value' => 'Sign up',
                'class' => 'btn btn-primary'
			],
		]);
	}
}


