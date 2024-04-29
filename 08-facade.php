<?php declare(strict_types = 1);


class UserPresenter
{

	protected function createComponentForm()
	{
		$form->onSuccess[] = function($form) {
			$this->userFacade->create($form);
		};
	}

}

class UserFacade
{

	public UserRepository $userRepository;

	public Mailer $mailer;

	public function create($data)
	{
		Assert::data($data);

		$this->userRepository->create([
			'name' => $data['name'],
			'email' => $data['email'],
		]);

		$this->mailer->send($data['email'], 'Welcome');
	}

}