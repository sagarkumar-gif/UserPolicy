<?php
namespace Application\Controller;

use Application\Service\UserServiceInterface;
use Zend\Db\Sql\Predicate\Like;
use Zend\Db\Sql\Where;
use Zend\InputFilter\InputFilterInterface;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{

	protected $userService;
    protected $signupFormFilter;   

	public function __construct(
		UserServiceInterface $userService,
		InputFilterInterface $signupFormFilter
	) {		
		$this->userService = $userService;
		$this->signupFormFilter = $signupFormFilter;		
	}	

	public function indexAction()
	{
		$userEntities = $this->userService->getUserByFilter();
		$userData = $userEntities->toArray();
		return new ViewModel([
			'users' => $userData,
		]);
	}
	
	public function allUsersAction()
	{
        $request = $this->getRequest();
        $response = $this->getResponse();
		$response->getHeaders()->addHeaderLine("Content-Type", "application/json");

        // Checks if the request is valid
	    if (!$request->isPost() || !$request->isXmlHttpRequest()) {
			$response->setContent(Json::encode(['error' => ['Very bad request']]));
			return $response;
	    }

	    // Gets user data
        $data = $this->getFormattedDataForDatatable();

        $response->setContent(Json::encode($data));
        return $response;
	}	
		
	protected function getFormattedDataForDatatable()
	{
        $request = $this->getRequest();

        $draw = intval($request->getPost('draw'));
        $limit = intval($request->getPost('length'));
        $offset = intval($request->getPost('start'));

        $search = strip_tags($request->getPost('search')['value']);
        if (!empty($search)) {
    		$where = function(Where $where) use($search) {
    			$where->like('firstname', "%$search%")
    			->or->like('lastname', "%$search%")
    			->or->like('policynumber', "%$search%")
    			->or->like('id', "%$search%");
    		};
	    } else {
	    	$where = null;
	    }
        
        $order = $request->getPost('order');
        if (!empty($order)) {
        	$columns = [
        		0 => 'id',
        		1 => 'firstname',
        		2 => 'lastname',
        		3 => 'policynumber',
        		4 => 'startdate',
        		5 => 'enddate',
        		6 => 'premium',

        	];
        	$columnNumber = intval($request->getPost('order')['0']['column']);
        	$column = $columns[$columnNumber];
        	$dir = strval($request->getPost('order')['0']['dir']);
        	$orderBy = "$column $dir";
        } else {
        	$orderBy = "id asc";
        }
     
		$userEntities = $this->userService->getUserByFilter($where, $orderBy, $limit, $offset);
		$filteredUsers = $userEntities->toArray();

		$tableContent = [];
		foreach ($filteredUsers as $user) {
			$prepareData = [];
			$prepareData[] = $user['id'];
			$prepareData[] = $user['firstname'];
			$prepareData[] = $user['lastname'];
			$prepareData[] = $user['policynumber'];
			$prepareData[] = $user['startdate'];
			$prepareData[] = $user['enddate'];
			$prepareData[] = $user['premium'];
			$prepareData[] = sprintf('<span class="glyphicon glyphicon-edit user-action-button" id="edit-this-user" aria-hidden="true" data-userid="%d"></span>', $user['id']);
			$prepareData[] = sprintf('<span class="glyphicon glyphicon-trash user-action-button" aria-hidden="true" data-userid="%d" data-toggle="modal" data-target="#user-delete-modal"></span>', $user['id']);
			$tableContent[] = $prepareData;	
		}

		if (null === $where) {
			$allUsers = $this->userService->getUserByFilter();
			$recordsTotal = count($allUsers);
			$recordsFiltered = $recordsTotal;
		} elseif (null !== $where) {
			$userEntities = $this->userService->getUserByFilter($where);
			$recordsTotal = count($userEntities->toArray());
			$recordsFiltered = $recordsTotal;
		}

        $data = [
        	'draw' => $draw,
        	'recordsTotal' => $recordsTotal,
        	'recordsFiltered' => $recordsFiltered,
        	'data' => $tableContent,
        ];       

        return $data;
	}

	public function handleAction()
	{
        $request = $this->getRequest();
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine("Content-Type", "application/json");

	    if (!$request->isPost() || !$request->isXmlHttpRequest()) {
			$response->setContent(Json::encode(['error' => ['Very bad request']]));
			return $response;
	    }	    

	    $rawUserId = $request->getPost('userId');
	    $userId = (int) $rawUserId;

		$filter = $this->signupFormFilter;
		$filter->setData($request->getPost());

		if (!empty($userId) && is_int($userId)) {
			if (!$filter->isValid()) {
				$errorMessages = $filter->getMessages();
				foreach ($errorMessages as $messages) {
					foreach ($messages as $message) {
						$errors[] = $message;
					}
				}
				$response->setContent(Json::encode(['error' => $errors]));
				return $response;
			}	    

			// Gets the data and user ID
			$data = $filter->getValues();
			$userId = (int) $data['userId'];
			unset($data['userId']);			

			if ($this->userService->updateUser($data, ['id' => $userId])) {
				$response->setContent(Json::encode(['success' => 'User updated']));
			} else {
				$response->setContent(Json::encode(['error' => ['Change any data and try again']]));
			}
		} else {
			if (!$filter->isValid()) {
				$errorMessages = $filter->getMessages();
				foreach ($errorMessages as $message) {
					foreach ($message as $msg) {
						$errors[] = $msg;
					}
				}
				$response->setContent(Json::encode(['error' => $errors]));
				return $response;
			}	

			// Gets the data and user ID
			$data = $filter->getValues();
			$userId = (int) $data['userId'];
			unset($data['userId']);


			if ($userId = $this->userService->registerUser($data)) {
				$response->setContent(Json::encode(['success' => 'User created', 'userId' => $userId])); 
			} else {
				$response->setContent(Json::encode(['error' => ['Could not create user']]));
			}
		}

		return $response;
	}

	public function singleUserAction()
	{
        $request = $this->getRequest();
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine("Content-Type", "application/json");

        // Checks if the request is valid
	    if (!$request->isPost() || !$request->isXmlHttpRequest()) {
			$response->setContent(Json::encode(['error' => ['Very bad request']]));
			return $response;
	    }

	    $userId = intval($request->getPost('userId'));
    	$userDetails = $this->userService->getUserById($userId);
    	if ($userDetails) {
    		$response->setContent(Json::encode(['user' => $userDetails]));
    	} else {
    		$response->setContent(Json::encode(['error' => ['User not found']]));
    	}
		
		return $response; 
	}	

	public function deleteUserAction()
	{
        $request = $this->getRequest();
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine("Content-Type", "application/json");

        // Checks if the request is valid
	    if (!$request->isPost() || !$request->isXmlHttpRequest()) {
			$response->setContent(Json::encode(['error' => ['Very bad request']]));
			return $response;
	    }

	    $userId = intval($request->getPost('userId'));
    	if ($this->userService->deleteUser(['id' => $userId])) {
    		$response->setContent(Json::encode(['success' => "User deleted"]));
    	} else {
    		$response->setContent(Json::encode(['error' => ['Could not find the user']]));
    	}
		
		return $response; 		
	}
				
}