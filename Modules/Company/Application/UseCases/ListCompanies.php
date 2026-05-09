<?php

declare(strict_types=1);

namespace Modules\Company\Application\UseCases;

use Modules\Company\Domain\Repositories\CompanyRepository;

final readonly class ListCompanies
{
    public function __construct(
        private CompanyRepository $companies,
    ) {
    }

    public function execute(): array
    {
        return $this->companies->all();
    }
}
