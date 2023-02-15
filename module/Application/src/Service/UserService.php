<?php 
namespace Application\Service;

use Interop\Container\ContainerInterface;
use Application\Mapper\UserMapperInterface;
use Zend\ServiceManager\ServiceManager;

class UserService implements UserServiceInterface
{
	/**
	 * @var UserMapperInterface
	 */
	protected $userMapper = null;

	/**
	 * @var ServiceManager
	 */
	protected $serviceManager = null;

	/**
     * {@inheritDoc} 
	 */
	public function getUserById($id) 
	{
		return $this->getUserMapper()->getById($id);
	}
    
    /**
     * {@inheritDoc} 
	 */
	public function getUserBypolicynumber($policynumber)
	{
		return $this->getUserMapper()->getBypolicynumber($policynumber);
	}

	/**
     * {@inheritDoc} 
	 */
	public function getUserBystartdate($startdate)
	{
		return $this->getUserMapper()->getUserBystartdate($startdate);
	}

    /**
     * {@inheritDoc} 
	 */
	public function getUserByenddate($enddate)
	{
		return $this->getUserMapper()->getUserByenddate($enddate);
	}

    /**
     * {@inheritDoc} 
	 */
	public function getUserBypremium($premium)
	{
		return $this->getUserMapper()->getUserBypremium($premium);
	}

	/**
     * {@inheritDoc} 
	 */
	public function getUserByFilter($where = null, $order = null, $limit = null, $offset = null)
	{
		return $this->getUserMapper()->getByFilter($where, $order, $limit, $offset);
	}	
    
    /**
     * {@inheritDoc} 
	 */
	public function registerUser($data)
	{	
		return $this->getUserMapper()->insert($data);
	}

    /**
     * {@inheritDoc} 
	 */
	public function updateUser($data, $where)
	{
		return $this->getUserMapper()->update($data, $where);
	}

    /**
     * {@inheritDoc} 
	 */
	public function deleteUser($where)
	{
		return $this->getUserMapper()->delete($where);
	}	

	/**
	 * Set user mapper
	 *
	 * @param UserMapperInterface $userMapper
	 */
	public function setUserMapper(UserMapperInterface $userMapper)
	{
		$this->userMapper = $userMapper;
		return $this;
	}

	/**
	 * Get user mapper
	 *	
	 * @return UserMapperInterface
	 */
	public function getUserMapper()
	{
		if (null === $this->userMapper) {
			$this->userMapper = $this->getServiceManager()->get('UserMapper');
		}
		return $this->userMapper;
	}

	/**
	 * Set service manager
	 *
	 * @param ContainerInterface $serviceManager
	 */
	public function setServiceManager(ContainerInterface $serviceManager) 
	{
		$this->serviceManager = $serviceManager;
		return $this;
	}

	/**
	 * Get service manager
	 *
	 * @return ServiceManager
	 */
	public function getServiceManager()
	{
		return $this->serviceManager;
	}		
}