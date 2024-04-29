<?php declare(strict_types = 1);

class UserPresenter
{

	public function actionList()
	{
		$filter = new UserFilter();
		$filter->setName('name', $this->getParameter('name'));
		$filter->setName('email', $this->getParameter('email'));
	}

	public function actionList()
	{
		$filter = new UserFilter();
		$parameters = $this->getParameters();
		if (isset($parameters['name'])) {
			$filter->setName('name', $parameters['name']);
		}
		if (isset($parameters['email'])) {
			$filter->setName('email', $parameters['email']);
		}
	}

}


class UserPresenter
{

	public function actionList()
	{
		$filter = UserFilter::fromRequest($this->getParameters());
	}

}

class UserFilter
{

	public static function fromRequest(array $parameters): self
	{
		$filter = new self();
		if (isset($parameters['name'])) {
			$filter->setName('name', $parameters['name']);
		}
		if (isset($parameters['email'])) {
			$filter->setName('email', $parameters['email']);
		}
		return $filter;
	}

	public static function fromConsole(array $args): self
	{
		$filter = new self();
		if (isset($args['--name'])) {
			$filter->setName('name', $args['--name']);
		}
		if (isset($args['email'])) {
			$filter->setName('email', $args['--email']);
		}
		return $filter;
	}

}

class UserPresenter
{

	public function actionList()
	{
		$this->bus->dispatch(
			new GetUsersQuery(
				filter: UserFilter::fromRequest($this->getParameters())
			)
		);
	}

}

class GetUsersQuery
{

	public function __construct(
		public UserFilter $filter
	)
	{
	}

}