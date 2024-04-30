<?php declare(strict_types = 1);

class CreateUserHandler
{

	public function handle(CreateUserCommand $command)
	{
		$user = new User();
		$user->name = $command->name;
		$user->email = $command->email;

		$this->entityManager->beginTransaction();

		try {
			$this->entityManager->persist($user);
			$this->entityManager->flush();
			$this->entityManager->commit();
		} catch (UniqueConstraintViolationException $e) {
			$this->entityManager->rollback();
			throw EntityExistsException::from($user, $e);
		}
	}

}