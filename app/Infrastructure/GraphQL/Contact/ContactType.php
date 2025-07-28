<?php declare(strict_types=1);

namespace App\Infrastructure\GraphQL\Contact;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

final class ContactType extends ObjectType
{
	public function __construct()
	{
		parent::__construct([
			'name' => 'Contact',
			'fields' => [
				'id' => Type::id(),
				'firstName' => Type::string(),
				'lastName' => Type::string(),
				'phone' => Type::string(),
				'createdAt' => Type::string(),
				'updatedAt' => Type::string()
			]
		]);
	}
}