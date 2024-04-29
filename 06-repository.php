<?php declare(strict_types = 1);


class UserPresenter
{

	public UserRepository $userRepository;

	public function actionDefault()
	{
		$users = $this->userRepository->findAll(['role' => 'admin']);
	}

	public function actionDetail($id)
	{
		$user = $this->userRepository->findBy(['id' => $id]);
	}

}

class UserRepository
{

	public Nette\Database\Connection $db;

	public function findAll($filters, $limit, $offset);
	public function findBy($filters);
	public function fetchBy($filters);
	public function create($data);
	public function update($data, $filters);
	public function delete($filters);

}
