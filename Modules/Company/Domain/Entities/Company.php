<?php

declare(strict_types=1);

namespace Modules\Company\Domain\Entities;

final readonly class Company
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $email,
        public string $address,
        public string $status,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {
    }

    /**
     * @return array{
     *     id: int|null,
     *     name: string,
     *     email: string,
     *     address: string,
     *     status: string,
     *     created_at: string|null,
     *     updated_at: string|null
     * }
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
