<?php

declare(strict_types=1);

namespace Modules\Company\Domain\Repositories;

use Modules\Company\Domain\Entities\Company;

interface CompanyRepository
{
    /**
     * @return array<int, Company>
     */
    public function all(): array;

    public function findById(int $companyId): Company;

    public function create(Company $company): Company;

    public function update(int $companyId, Company $company): Company;

    public function delete(int $companyId): void;
}
