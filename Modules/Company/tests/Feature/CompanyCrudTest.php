<?php

declare(strict_types=1);

namespace Modules\Company\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        putenv('DB_CONNECTION=sqlite');
        putenv('DB_DATABASE=:memory:');
        $_ENV['DB_CONNECTION'] = 'sqlite';
        $_ENV['DB_DATABASE'] = ':memory:';
        $_SERVER['DB_CONNECTION'] = 'sqlite';
        $_SERVER['DB_DATABASE'] = ':memory:';

        parent::setUp();

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');
    }

    public function test_company_can_be_created(): void
    {
        $response = $this->postJson('/api/v1/companies', [
            'name' => 'Acme Inc.',
            'email' => 'hello@acme.test',
            'address' => 'Kathmandu',
            'status' => 'active',
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.name', 'Acme Inc.')
            ->assertJsonPath('data.email', 'hello@acme.test');

        $this->assertDatabaseHas('companies', [
            'email' => 'hello@acme.test',
        ]);
    }
}
