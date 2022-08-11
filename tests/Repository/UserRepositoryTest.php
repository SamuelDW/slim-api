<?php

declare(strict_types=1);

use App\User\UserRepository;
use PHPUnit\Framework\TestCase;

final class UserRepositoryTest extends TestCase

{
    /**
     * Test that a user can be found with an email
     *
     * @return void
     */
    public function testFindUserByEmail(): void
    {

    }

    public function testFindUserByEmailWhereUserNotExists(): void
    {

    }
}
