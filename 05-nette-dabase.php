<?php declare(strict_types = 1);


class UserPresenter
{

	public UserModel $userModel;

	public function actionDefault()
	{
		$users = $this->userModel->getUsers();
	}

	public function actionDetail($id)
	{
		$user = $this->userModel->getUser($id);
	}

}

class UserModel
{

	public Nette\Database\Connection $db;

	public function getUser($id)
	{
		return $this->db->fetch('SELECT * FROM users WHERE id = ?', $id);
	}
	public function getUsers($filters = [])
	{
		return $this->db->fetchAll('SELECT * FROM users WHERE', $filters);
	}

}
