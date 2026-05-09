<?php

declare(strict_types=1);

namespace Modules\Company\Providers;

use Modules\Company\Domain\Repositories\CompanyRepository;
use Modules\Company\Infrastructure\Persistence\Eloquent\Repositories\EloquentCompanyRepository;
use Nwidart\Modules\Support\ModuleServiceProvider;

class CompanyServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'Company';

    protected string $nameLower = 'company';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    public function register(): void
    {
        parent::register();

        $this->app->bind(CompanyRepository::class, EloquentCompanyRepository::class);
    }
}
