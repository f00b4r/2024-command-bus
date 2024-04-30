<?php declare(strict_types = 1);

$neon = <<<'NEON'
services:
	fooFactory: FooFactory
	barFactory: BarFactory

	eventFactory:
		class: EventFactory
		setup:
			- addFactory('foo', @fooFactory)
			- addFactory('bar', @barFactory)
NEON;

class BarFactory
{

}

class EventFactory
{

	public function add(object $factory): void
	{
	}

	public function create(string $event): Event
	{

	}

}

class FooFactory
{

}

public function createServiceBarFactory(): BarFactory
{
	return new BarFactory;
}

public function createServiceFooFactory(): FooFactory
{
	return new FooFactory;
}

public function createServiceEventFactory(): EventFactory
{
	$service = new EventFactory;
	$service->addFactory('foo', $this->getService('fooFactory'));
	$service->addFactory('bar', $this->getService('barFactory'));
	return $service;
}

class EventService
{

	public function __construct(EventFactory $eventFactory)
	{
	}

}

class Container
{

	public function getService($service)
	{
		if (!isset($this->services[$service])) {
			$this->services[$service] = $this->{'createService' . ucfirst($service)}();
		}
		return $this->services[$service];
	}

}

Interface EventFactory
{

	public function create(string $name): Event

}

class ContainerEventFactory
{

	private array $factories = [];
	private array $services = [];

	public function __construct(
		private Container $container
	)
	{
	}

	public function add(string $factory, string $event): void
	{
		$this->factories[$event] = $factory;
	}

	public function create(string $event): Event
	{
		if (!isset($this->services[$event])) {
			$this->services[$event] = $this->container->getService($this->factories[$event]);
		}

		return $this->factories[$event]->create($event);
	}

}