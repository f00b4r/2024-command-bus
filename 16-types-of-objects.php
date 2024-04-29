<?php declare(strict_types = 1);

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class UserEntity
{

	#[ORM\Column(type: 'uuid', unique: true)]
	#[ORM\Id]
	public UuidInterface|string $uuid;

	#[ORM\Column(type: 'text', nullable: false)]
	public string $name;

}

class EmailValueObject
{

	public function __construct(string $email)
	{
		if (!Validators::isEmail($email)) {
			throw new InvalidArgumentException;
		}

		$this->email = $email;
	}

}

class UserDto
{

	public function __construct(
		public string $name,
		public EmailValueObject $email
	)
	{
	}

	public function format(): string
	{
		return sprintf('%s <%s>', $this->name, $this->email->email);
	}

}