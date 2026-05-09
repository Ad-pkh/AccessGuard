<?php

declare(strict_types=1);

namespace Modules\Company\Application\UseCases;

use Modules\Company\Domain\Repositories\CompanyRepository;

final readonly class DeleteCompany
{
    public function __construct(
        private CompanyRepository $companies,
    ) {
    }

    public function execute(int $companyId): void
    {
        $this->companies->delete($companyId);
    }
}
