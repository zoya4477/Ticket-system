<?php

use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase {
    protected $ticket;

    protected function setUp(): void {
        // Initialize Ticket class before each test
        $this->ticket = new Ticket();
    }

    public function testCreateTicket() {
        $this->ticket->setTitle('Test Ticket');
        $this->ticket->setDescription('This is a test description.');
        $result = $this->ticket->create();
        $this->assertTrue($result);
        $this->assertNotNull($this->ticket->getId()); // Ensure the ticket ID is set
    }

    public function testUpdateTicket() {
        $this->ticket->setId(1);
        $this->ticket->setTitle('Updated Ticket Title');
        $result = $this->ticket->update();
        $this->assertTrue($result);
        $this->assertEquals('Updated Ticket Title', $this->ticket->getTitle());
    }

    public function testDeleteTicket() {
        $this->ticket->setId(1);
        $result = $this->ticket->delete();
        $this->assertTrue($result);
        $this->assertNull($this->ticket->findById(1)); // Ensure ticket no longer exists
    }

    public function testChangeStatus() {
        $this->ticket->setId(1);
        $this->ticket->setStatus('closed');
        $result = $this->ticket->changeStatus();
        $this->assertTrue($result);
        $this->assertEquals('closed', $this->ticket->getStatus());
    }

    public function testChangePriority() {
        $this->ticket->setId(1);
        $this->ticket->setPriority('high');
        $result = $this->ticket->changePriority();
        $this->assertTrue($result);
        $this->assertEquals('high', $this->ticket->getPriority());
    }

    public function testValidation() {
        $this->ticket->setTitle(''); // Invalid title
        $result = $this->ticket->validate();
        $this->assertFalse($result);
        $this->assertContains('Title cannot be empty', $this->ticket->getErrors());
    }

    public function testRelationships() {
        // Ensure ticket has the correct relationship with user
        $this->ticket->setId(1);
        $user = $this->ticket->getUser();
        $this->assertInstanceOf(User::class, $user);
    }

    public function testEdgeCases() {
        $this->ticket->setDescription(str_repeat('A', 1001)); // Exceeds max length
        $this->assertFalse($this->ticket->validate());
    }

    public function testErrorHandling() {
        $this->ticket->setId(999); // Non-existent ticket
        $result = $this->ticket->delete();
        $this->assertFalse($result);
        $this->assertContains('Ticket not found', $this->ticket->getErrors());
    }
}

?>