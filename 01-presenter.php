<?php declare(strict_types = 1);


class UserPresenter
{

	public function actionDefault()
	{
		$pdo = new PDO('...');
		$stmt = $pdo->prepare('SELECT * FROM users');
		$stmt->execute();
		$users = $stmt->fetchAll();

		$this->template->users = $users;
	}

}