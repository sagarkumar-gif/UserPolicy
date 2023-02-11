<?php 
namespace Application\Factory\Mapper;

use Interop\Container\ContainerInterface;
use Application\Mapper\UserMapper;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserMapperFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		$dbAdapter = $container->get('Zend\Db\Adapter\Adapter');
		$userMapper = new UserMapper();
		$userMapper->setAdapter($dbAdapter);
		$userMapper->setTable('tbl_policy_users');
		return $userMapper;
	}
}