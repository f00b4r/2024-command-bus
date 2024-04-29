<?php declare(strict_types = 1);

class UserPresenter
{

	protected function createComponentForm()
	{
		$form->onSuccess[] = function($form) {
			$user = $this->commandBus->dispatch(
				new CreateUserCommand(
					$form->values->name,
					$form->values->email
				)
			);

			$this->flashMessage(
				sprintf('User %s created', $user['name'])
			);
		};
	}

}

class CreateUserHandler
{

	public function handle(CreateUserCommand $command) {
		$data = [
			'name' => $command->name,
			'email' => $command->email,
		];

		$user = $this->userRepository->create($data);

		return $user;
	}

}
