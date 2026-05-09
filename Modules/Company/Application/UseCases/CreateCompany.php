<?php

declare(strict_types=1);

namespace Modules\Company\Application\UseCases;

use Modules\Company\Application\DataTransferObjects\CompanyData;
use Modules\Company\Domain\Entities\Company;
use Modules\Company\Domain\Repositories\CompanyRepository;

final readonly class CreateCompany
{
    public function __construct(
        private CompanyRepository $companies,
    ) {
    }

    public function execute(CompanyData $companyData): Company
    {
        return $this->companies->create($companyData->toEntity());
    }
}
