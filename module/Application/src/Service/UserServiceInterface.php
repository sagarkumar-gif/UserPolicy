<?php
namespace Application\Service;

interface UserServiceInterface 
{
	public function getUserById($id);
	public function getUserBypolicynumber($policynumber);
	public function getUserBystartdate($startdate);
	public function getUserByenddate($enddate);
	public function getUserBypremium($premium);
	public function getUserByFilter();
	public function registerUser($data);
	public function updateUser($data, $where);
	public function deleteUser($where);				
}

