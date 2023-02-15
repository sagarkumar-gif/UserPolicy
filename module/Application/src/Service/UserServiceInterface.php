<?php
namespace Application\Service;

interface UserServiceInterface 
{
	/**
	 * Gets user by ID
	 *
	 * @param int $id
	 * @return UserInterface
	 */
	public function getUserById($id);

	/**
	 * Gets user by policynumber
	 *
	 * @param integer $policynumber
	 * @return UserInterface
	 */
	public function getUserBypolicynumber($policynumber);

    /**
	 * Gets user by startdate
	 *
	 * @param date $startdate
	 * @return UserInterface
	 */
	public function getUserBystartdate($startdate);

	/**
	 * Gets user by enddate
	 *
	 * @param date $enddate
	 * @return UserInterface
	 */
	public function getUserByenddate($enddate);

	/**
	 * Gets user by premium
	 *
	 * @param integer $premium
	 * @return UserInterface
	 */
	public function getUserBypremium($premium);

	/**
	 * Gets all users or by filter
	 *
	 * @return UserInterface
	 */
	public function getUserByFilter();

	/**
	 * Registers new user
	 *
	 * @param array $data
	 * @return mixed|null
	 */
	public function registerUser($data);

	/**
	 * Updates user
	 *
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return bool
	 */
	public function updateUser($data, $where);

	/**
	 * Deletes user
	 *
	 * @param Where|\Closure|string|array $where
	 * @param bool
	 */
	public function deleteUser($where);				
}

