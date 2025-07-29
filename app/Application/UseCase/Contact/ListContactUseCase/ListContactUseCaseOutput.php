<?php

declare(strict_types=1);

namespace App\Application\UseCase\Contact\ListContactUseCase;

use App\Domain\VO\ContactVO;

final readonly class ListContactUseCaseOutput
{
	/**
	 * @param array<ContactVO> $contacts
	 */
	public function __construct(public array $contacts)
	{
	}
}
