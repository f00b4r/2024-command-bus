<?php declare(strict_types = 1);


class User1Presenter
{

	public function actionDefault()
	{
		$users = DB::getUsers();
	}

}

class User2Presenter
{

	public function actionDefault()
	{
		$users = \App\DB::getUsers();
	}

}

class DB {

	public static function getUsers()
	{
		$pdo = new PDO('...');
		$stmt = $pdo->prepare('SELECT * FROM users');
		$stmt->execute();
		return $stmt->fetchAll();
	}

}