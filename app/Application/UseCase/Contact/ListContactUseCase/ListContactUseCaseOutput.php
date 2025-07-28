<?php

namespace App\Application\UseCase\Contact\ListContactUseCase;

final readonly class ListContactUseCaseOutput
{

	/**
	 * @param array<ListContactUseCaseVO> $contacts
	 */
	public function __construct(public array $contacts)
	{
	}

}