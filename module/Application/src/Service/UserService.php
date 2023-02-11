<?php 
namespace Application\Service;

use Interop\Container\ContainerInterface;
use Application\Mapper\UserMapperInterface;
use Zend\ServiceManager\ServiceManager;

class UserService implements UserServiceInterface
{
	protected $userMapper = null;
	protected $serviceManager = null;

	public function getUserById($id) 
	{
		return $this->getUserMapper()->getById($id);
	}

	public function getUserBypolicynumber($policynumber)
	{
		return $this->getUserMapper()->getBypolicynumber($policynumber);
	}

	public function getUserBystartdate($startdate)
	{
		return $this->getUserMapper()->getUserBystartdate($startdate);
	}

	public function getUserByenddate($enddate)
	{
		return $this->getUserMapper()->getUserByenddate($enddate);
	}

	public function getUserBypremium($premium)
	{
		return $this->getUserMapper()->getUserBypremium($premium);
	}

	public function getUserByFilter($where = null, $order = null, $limit = null, $offset = null)
	{
		return $this->getUserMapper()->getByFilter($where, $order, $limit, $offset);
	}	

	public function registerUser($data)
	{	
		return $this->getUserMapper()->insert($data);
	}

	public function updateUser($data, $where)
	{
		return $this->getUserMapper()->update($data, $where);
	}

	public function deleteUser($where)
	{
		return $this->getUserMapper()->delete($where);
	}	

	public function setUserMapper(UserMapperInterface $userMapper)
	{
		$this->userMapper = $userMapper;
		return $this;
	}

	public function getUserMapper()
	{
		if (null === $this->userMapper) {
			$this->userMapper = $this->getServiceManager()->get('UserMapper');
		}
		return $this->userMapper;
	}

	public function setServiceManager(ContainerInterface $serviceManager) 
	{
		$this->serviceManager = $serviceManager;
		return $this;
	}

	public function getServiceManager()
	{
		return $this->serviceManager;
	}		
}