<?php
use PHPUnit\Framework\TestCase;

class TicketModelTest extends TestCase
{
    public function testCreatingTicket()
    {
        // Arrange
        $ticket = new Ticket();

        // Act
        $ticket->title = 'Test Ticket';
        $ticket->description = 'Test Description';
        $ticket->save();

        // Assert
        $this->assertDatabaseHas('tickets', [
            'title' => 'Test Ticket',
            'description' => 'Test Description'
        ]);
    }

    // Additional tests here...
}