<?php declare(strict_types = 1);

class ComplexCreateUserHandler
{

	public function handle(CreateUserCommand $command) {
		$this->bus->dispatch(new CreateUserCommand());
		$this->bus->dispatch(new SetupUserCommand());
		$this->bus->dispatch(new MakeUserFreeCommand());
	}

}

class ComplexCreateUserHandler
{

	public function handle(CreateUserCommand $command) {
		$this->bus->dispatch(new CreateUserCommand());

		$this->eventDispatcher->dispatch(UserCreated::create());
	}

}