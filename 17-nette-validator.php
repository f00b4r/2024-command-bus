<?php declare(strict_types = 1);

if (!Validators::isEmail($email)) {
	throw new InvalidArgumentException;
}


if (!Validators::is($val, 'int|string|bool')) {
	// ...
}


$arr = ['foo' => 'Nette'];

Validators::assertField($arr, 'foo', 'string:5');
Validators::isNumeric(23);
Validators::isNone(0);
Validators::isTypeDeclaration('string|null');
Validators::isUrl('https://nette.org:8080/path?query#fragment');

Validators::assert*; // throws exception

Validators::is*; // return bool