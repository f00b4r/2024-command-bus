<?php declare(strict_types = 1);

$schema = Expect::structure([
	'uuid' => Expect::string(),
	'name' => Expect::string()->required(),
	'description' => Expect::string()->required(),
	'created' => Expect::string()
		->assert(static fn ($date) => Validators::isDateTime($date), 'datetime'),
	'owner' => Expect::string()->required(),
])->castTo(CreateProjectDto::class);


try {
	$normalized = (new Process())->process($schema, $data);
} catch (ValidationException $e) {
	echo 'Data is invalid: ' . $e->getMessage();
}
