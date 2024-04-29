<?php declare(strict_types = 1);


class UserPresenter
{

	public UserModel $userModel;

	public function actionDefault()
	{
		$users = $this->userModel->getUsers();
	}

}

class UserModel
{

	public DB $db;

	public function getUsers()
	{
		return $this->db->query('SELECT * FROM users');
	}

}

class DB {

	public function query($sql) {
		// ...
	}

}