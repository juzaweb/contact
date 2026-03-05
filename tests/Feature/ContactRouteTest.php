<?php

namespace Juzaweb\Modules\Contact\Tests\Feature;

use Juzaweb\Modules\Contact\Tests\TestCase;
use Illuminate\Support\Facades\Notification;

class ContactRouteTest extends TestCase
{
    /** @test */
    public function unauthenticated_users_are_redirected_from_admin_contact_routes()
    {
        $adminPrefix = config('core.admin_prefix', 'admin-cp');

        $response = $this->get($adminPrefix . '/contacts');
        $response->assertRedirect();

        $response = $this->get($adminPrefix . '/contacts/1/edit');
        $response->assertRedirect();
    }

    /** @test */
    public function it_can_validate_contact_store_route()
    {
        $response = $this->post(route('contact.store'), []);
        $response->assertStatus(302);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    /** @test */
    public function it_can_store_a_contact()
    {
        Notification::fake();

        // Need to use email domain with valid dns records for email:rfc,dns rule
        $data = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'subject' => 'Hello World!',
            'message' => 'This is the test message',
        ];

        $response = $this->postJson(route('contact.store'), $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('contacts', [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'subject' => 'Hello World!',
        ]);

        Notification::assertSentTo(
            new \Illuminate\Notifications\AnonymousNotifiable,
            \Juzaweb\Modules\Contact\Notifications\ThankNotification::class,
            function ($notification, $channels, $notifiable) use ($data) {
                return $notifiable->routes['mail'] === $data['email'];
            }
        );
    }
}
