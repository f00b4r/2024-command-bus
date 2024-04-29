<?php declare(strict_types = 1);


class UserPresenter
{

	protected function createComponentForm()
	{
		$form->onSuccess[] = function($form) {
			$this->userRepository->create([
				'name' => $form->values->name,
				'email' => $form->values->email,
			]);
		};
	}

}

class UserApi
{

	public function __invoke(Request $request)
	{
		$this->userRepository->create([
			'name' => $request->values->name,
			'email' => $request->values->email,
		]);
	}

}

// =========

class UserPresenter
{

	protected function createComponentForm()
	{
		$form->onSuccess[] = function($form) {
			$this->userService->create($form->values);
			$this->mailer->send($form->values->email, 'Welcome');
		};
	}

}

class UserApi
{

	public function __invoke(Request $request)
	{
		$this->userService->create($request->values);
		$this->mailer->send($request->values->email, 'Welcome');
	}

}

class UserService
{

	public UserRepository $userRepository;

	public function create($data)
	{
		Assert::string($data, 'name');
		Assert::email($data, 'email');

		$this->userRepository->create([
			'name' => $data['name'],
			'email' => $data['email'],
		]);
	}

}
