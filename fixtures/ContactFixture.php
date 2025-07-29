<?php

namespace DataFixtures;

use App\Application\Repository\ContactRepository;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Nette\DI\Container;
use Nettrine\Fixtures\Fixture\ContainerAwareInterface;

final readonly class ContactFixture implements FixtureInterface, ContainerAwareInterface
{

	private ContactRepository $contactRepository;

	public function setContainer(Container $container): void
	{
		$this->contactRepository = $container->getByType(ContactRepository::class);
	}


	public function load(ObjectManager $manager): void
	{
		$contacts = [
			['firstName' => 'John', 'lastName' => 'Doe', 'phone' => '420123456789'],
			['firstName' => 'Jane', 'lastName' => 'Smith', 'phone' => '421987654321'],
			['firstName' => 'Alice', 'lastName' => 'Johnson', 'phone' => '422555444333'],
			['firstName' => 'Bob', 'lastName' => 'Brown', 'phone' => '423444333222'],
			['firstName' => 'Charlie', 'lastName' => 'Davis', 'phone' => '424333222111'],
			['firstName' => 'Eve', 'lastName' => 'Wilson', 'phone' => '425222111000'],
			['firstName' => 'Frank', 'lastName' => 'Garcia', 'phone' => '426111000999'],
			['firstName' => 'Grace', 'lastName' => 'Martinez', 'phone' => '427666555444'],
			['firstName' => 'Hank', 'lastName' => 'Lopez', 'phone' => '428777666555'],
			['firstName' => 'Ivy', 'lastName' => 'Gonzalez', 'phone' => '429888777666'],
			['firstName' => 'Jack', 'lastName' => 'Taylor', 'phone' => '430999888777'],
			['firstName' => 'Kelly', 'lastName' => 'Anderson', 'phone' => '431234567890'],
			['firstName' => 'Luke', 'lastName' => 'Thomas', 'phone' => '432345678901'],
			['firstName' => 'Mary', 'lastName' => 'Jackson', 'phone' => '433456789012'],
			['firstName' => 'Nick', 'lastName' => 'White', 'phone' => '434567890123'],
			['firstName' => 'Olivia', 'lastName' => 'Harris', 'phone' => '435678901234'],
			['firstName' => 'Paul', 'lastName' => 'Martin', 'phone' => '436789012345'],
			['firstName' => 'Quinn', 'lastName' => 'Thompson', 'phone' => '437890123456'],
			['firstName' => 'Rachel', 'lastName' => 'Garcia', 'phone' => '438901234567'],
			['firstName' => 'Steve', 'lastName' => 'Martinez', 'phone' => '439012345678'],
			['firstName' => 'Tina', 'lastName' => 'Robinson', 'phone' => '440123456789'],
			['firstName' => 'Uma', 'lastName' => 'Clark', 'phone' => '441234567890'],
			['firstName' => 'Victor', 'lastName' => 'Rodriguez', 'phone' => '442345678901'],
			['firstName' => 'Wendy', 'lastName' => 'Lee', 'phone' => '443456789012'],
			['firstName' => 'Xavier', 'lastName' => 'Walker', 'phone' => '444567890123'],
			['firstName' => 'Yolanda', 'lastName' => 'Hall', 'phone' => '445678901234'],
			['firstName' => 'Zack', 'lastName' => 'Allen', 'phone' => '446789012345'],
			['firstName' => 'Amy', 'lastName' => 'Young', 'phone' => '447890123456'],
			['firstName' => 'Brad', 'lastName' => 'King', 'phone' => '448901234567'],
			['firstName' => 'Cathy', 'lastName' => 'Wright', 'phone' => '449012345678'],
		];

		foreach ($contacts as $contactData) {
			$contact = $this->contactRepository->createEntity();
			$contact->setFirstName($contactData['firstName']);
			$contact->setLastName($contactData['lastName']);
			$contact->setPhone($contactData['phone']);
			$contact->setCreatedAt(new \DateTimeImmutable());
			$this->contactRepository->insert($contact);
		}
	}

}