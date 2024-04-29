<?php declare(strict_types = 1);

class UserPresenter
{

	protected function createComponentForm()
	{
		$form->onSuccess[] = function($form) {
			$this->commandBus->dispatch(
				new CreateUserCommand(
					$form->values->name,
					$form->values->email
				)
			);
		};
	}

}

class CreateUserCommand
{

	public function __construct(
		public string $name,
		public string $email
	)
	{
	}

}

class CreateUserHandler
{

	public function handle(CreateUserCommand $command) {
		$data = [
			'name' => $command->name,
			'email' => $command->email,
		];

		$this->userRepository->create($data);
	}

}

class CommandBus
{

	public function dispatch($command) {
		if ($command instanceof CreateUserCommand) {
			$this->createUserHandler->handle($command);
		}
		// ...
	}

}