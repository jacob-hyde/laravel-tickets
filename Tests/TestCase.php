<?php

namespace JacobHyde\Tickets\Tests;

use JacobHyde\Tickets\TicketsServiceProvider;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    /**
     * @var Generator
     */
    public Generator $faker;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
    }

    protected function getPackageProviders($app)
    {
        return [
            TicketsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();
        $this->runLaravelMigrations();
        $this->seed();
    }
}
