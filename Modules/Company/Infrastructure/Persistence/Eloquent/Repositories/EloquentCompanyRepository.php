<?php

declare(strict_types=1);

namespace Modules\Company\Infrastructure\Persistence\Eloquent\Repositories;

use Modules\Company\Domain\Entities\Company;
use Modules\Company\Domain\Repositories\CompanyRepository;
use Modules\Company\Infrastructure\Entities\CompanyModel;

final readonly class EloquentCompanyRepository implements CompanyRepository
{
    public function __construct(
        private CompanyModel $model,
    ) {
    }

    public function all(): array
    {
        return $this->model
            ->newQuery()
            ->latest('id')
            ->get()
            ->map(fn (CompanyModel $company): Company => $this->toDomain($company))
            ->all();
    }

    public function findById(int $companyId): Company
    {
        $company = $this->model->newQuery()->findOrFail($companyId);

        return $this->toDomain($company);
    }

    public function create(Company $company): Company
    {
        $record = $this->model->newQuery()->create($this->toPersistence($company));
        $record->refresh();

        return $this->toDomain($record);
    }

    public function update(int $companyId, Company $company): Company
    {
        $record = $this->model->newQuery()->findOrFail($companyId);
        $record->fill($this->toPersistence($company));
        $record->save();
        $record->refresh();

        return $this->toDomain($record);
    }

    public function delete(int $companyId): void
    {
        $this->model->newQuery()->findOrFail($companyId)->delete();
    }

    private function toDomain(CompanyModel $company): Company
    {
        return new Company(
            id: $company->id,
            name: $company->name,
            email: $company->email,
            address: $company->address,
            status: $company->status,
            createdAt: $company->created_at?->toAtomString(),
            updatedAt: $company->updated_at?->toAtomString(),
        );
    }

    /**
     * @return array{name: string, email: string, address: string, status: string}
     */
    private function toPersistence(Company $company): array
    {
        return [
            'name' => $company->name,
            'email' => $company->email,
            'address' => $company->address,
            'status' => $company->status,
        ];
    }
}
