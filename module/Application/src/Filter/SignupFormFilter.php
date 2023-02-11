<?php
namespace Application\Filter;

use Zend\Filter;
use Zend\InputFilter;
use Zend\Stdlib\RequestInterface;
use Zend\Validator;

class SignupFormFilter extends InputFilter\InputFilter
{
	/**
	 * @var RequstInterface
	 */
	protected $request;

	public function __construct(RequestInterface $request)
	{	
		// Current request object
		$this->request = $request;
		$this->addFilters();
	}

	public function addFilters()
	{
		$this->add([
			'name' => 'userId',
			'required' => $this->request->getPost('userId') ? true : false,
			'filters' => [
				['name' => Filter\ToInt::class],
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],		
		]);
		$this->add([
			'name' => 'firstname',
			'required' => true,
			'filters' => [
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'message' => 'First name can not be empty',
					],
					'break_chain_on_failure' => true,
				],
			],
		]);

		$this->add([
			'name' => 'lastname',
			'required' => true,
			'filters' => [
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'message' => 'Last name can not be empty',
					],
					'break_chain_on_failure' => true,
				],
			],
		]);	

		$this->add([
			'name' => 'policynumber',
			'required' => true,
			'filters' => [
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'message' => 'Policy number can not be empty',
					],
					'break_chain_on_failure' => true,
				],
			],
		]);	

		$this->add([
			'name' => 'startdate',
			'required' => true,
			'filters' => [
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'message' => 'Start date can not be empty',
					],
					'break_chain_on_failure' => true,
				],
			],
		]);	

		$this->add([
			'name' => 'enddate',
			'required' => true,
			'filters' => [
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'message' => 'End date can not be empty',
					],
					'break_chain_on_failure' => true,
				],
			],
		]);	


		$this->add([
			'name' => 'premium',
			'required' => true,
			'filters' => [
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'message' => 'premium can not be empty',
					],
					'break_chain_on_failure' => true,
				],
			],
		]);		

	}
}