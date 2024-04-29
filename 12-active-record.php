<?php declare(strict_types = 1);

class UserPresenter
{

	protected function createComponentForm()
	{
		$form->onSuccess[] = function($form) {
			$userRecord = $this->commandBus->dispatch(
				new CreateUserCommand(
					$form->values->name,
					$form->values->email
				)
			);

			$this->flashMessage(
				sprintf('User %s created', $userRecord->name)
			);

			$userRecord->ref('profile')->nickname;
			$userRecord->update(['email' => 'john@email.tld']);
			$userRecord->delete();
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

		$userRecord = $this->userRepository->create($data);

		return $userRecord;
	}

}
