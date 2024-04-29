<?php declare(strict_types = 1);

class UserFacade
{

	public function __construct(
		UserRepository $userRepository,
		ProfileRepository $profileRepository,
		Translator $translator,
		AcmeHttpConnector $httpConnector,
		CurrencyConverter $currencyConverter,
		DataValidator $dataValidator,
		Mailer $mailer
	)
	{
	}

	public function createUser(...);
	public function updateUser(...);
	public function delateUser(...);
	public function findUserById(...);
	public function findAllUsers(...);
	public function sendEmailToUsers(...);
	public function deactivateUsers(...);
	public function activateProfiles(...);

}