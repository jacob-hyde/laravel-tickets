<?php

namespace JacobHyde\Tickets\Tests\Feature;

use JacobHyde\Tickets\App\Actions\CreateTicket;
use JacobHyde\Tickets\App\Models\Category;
use JacobHyde\Tickets\App\Models\Ticket;
use JacobHyde\Tickets\Tests\TestCase;

class CreateTicketTest extends TestCase
{
    public function testAction()
    {
        CreateTicket::shouldRun()
            ->shouldReceive('handle')
            ->with($this->getTicketData());
    }

    public function testModel()
    {
        $ticket = CreateTicket::run($this->getTicketData());
        dd($ticket);
    }

    private function getTicketData(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
        ];
    }
}