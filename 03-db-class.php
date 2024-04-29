<?php declare(strict_types = 1);


class UserPresenter
{

	public DB $db;

	public function actionDefault()
	{
		$users = $this->db->getUsers();
	}

}

class DB {

	public function __construct($host, $user, $password)
	{
		$this->pdo = new PDO($host, $user, $password);
	}

	public function getUsers()
	{
		$stmt = $this->pdo->prepare('SELECT * FROM users');
		$stmt->execute();
		return $stmt->fetchAll();
	}

}