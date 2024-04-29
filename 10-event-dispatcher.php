<?php declare(strict_types = 1);

class CreateUserHandler
{

	public function handle(CreateUserCommand $command) {
		$data = [
			'name' => $command->name,
			'email' => $command->email,
		];

		$this->userRepository->create($data);

		$this->mailer->send($command->email, 'Welcome');

		$this->logger->info('User created', $data);
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

		$this->eventDispatcher->dispatch(
			new UserCreatedEvent($data)
		);
	}

}

class EventDispatcher
{

	public function dispatch($event) {
		foreach ($this->subscribers[$event] as $subscriber) {
			$subscriber->handle($event);
		}
	}

}

class LoggerSubscriber
{

	public static function getSubscribedEvents()
	{
		return [UserCreatedEvent::class => 'handle'];
	}

	public function handle(UserCreatedEvent $event) {
		$this->logger->info('User created', $event->data);
	}

}