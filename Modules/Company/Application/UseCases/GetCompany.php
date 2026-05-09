<?php

declare(strict_types=1);

namespace Modules\Company\Application\UseCases;

use Modules\Company\Domain\Entities\Company;
use Modules\Company\Domain\Repositories\CompanyRepository;

final readonly class GetCompany
{
    public function __construct(
        private CompanyRepository $companies,
    ) {
    }

    public function execute(int $companyId): Company
    {
        return $this->companies->findById($companyId);
    }
}
