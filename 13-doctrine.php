<?php declare(strict_types = 1);

class CreateUserHandler
{

	public function handle(CreateUserCommand $command) {
		$user = new User();
		$user->name = $command->name;
		$user->email = $command->email;

		$this->entityManager->persist($user);
		$this->entityManager->flush();
	}

}

class CreateUserHandler
{

	public function handle(CreateUserCommand $command) {
		$user = new User();
		$user->name = $command->name;
		$user->email = $command->email;

		try {
			$this->entityManager->persist($user);
			$this->entityManager->flush();
		} catch (UniqueConstraintViolationException $e) {
			throw EntityExistsException::from($user, $e);
		}
	}

}

class UpdateUserHandler
{

	public function handle(UpdateUserHandler $command)
	{
		$user = $this->entityManager
			->getRepository(User::class)
			->findOneBy(['uuid' => $command->uuid]);

		if ($user === null) {
			throw EntityNotFoundException::byUuid($command->uuid);
		}

		if ($command->name !== null) {
			$user->name = $command->name;
		}

		$this->entityManager->persist($user);
		$this->entityManager->flush();
	}

}
