<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    /**
     * Test the user creation endpoint.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = factory('App\User')->make();
        $this->post('/users', $user->toArray())->seeJson([
            "name" => $user->name,
            "email" => $user->email,
            "phone" => $user->phone,
            "level" => $user->level,
        ]);
        $this->assertNotNull($this->response->getOriginalContent()['external_id']);
    }

    /**
     * Test the user creation endpoint.
     *
     * @return void
     */
    public function testChangeUserLevel()
    {
        $user = factory('App\User')->make();
        $this->post('/users', $user->toArray());
        $user = $this->response->getOriginalContent();
        $action = $user['level'] === 'F' ? 'upgrade' : 'downgrade';
        $this->put("/users/{$user['id']}/{$action}")->seeJson([
            "name" => $user['name'],
            "email" => $user['email'],
            "phone" => $user['phone'],
            "level" => $action === 'upgrade' ? 'P' : 'F',
            "external_id" => $user['external_id']
        ]);
    }
}
