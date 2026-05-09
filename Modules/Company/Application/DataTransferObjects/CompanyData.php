<?php

declare(strict_types=1);

namespace Modules\Company\Application\DataTransferObjects;

use Modules\Company\Domain\Entities\Company;

final readonly class CompanyData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $address,
        public string $status,
    ) {
    }

    /**
     * @param array{name: string, email: string, address: string, status: string} $payload
     */
    public static function fromArray(array $payload): self
    {
        // dd($payload);
        return new self(
            name: $payload['name'],
            email: $payload['email'],
            address: $payload['address'],
            status: $payload['status'],
        );
    }

    public function toEntity(?int $id = null): Company
    {
        return new Company(
            id: $id,
            name: $this->name,
            email: $this->email,
            address: $this->address,
            status: $this->status,
        );
    }
}
