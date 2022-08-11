<?php

declare(strict_types=1);

namespace App\User;

use App\Database\DB;
use \PDO;

class UserRepository
{
    /**
     * Gets a user by their email
     *
     * @param string $email
     * @return array
     */
    public function findUserByEmail(string $email): array
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT * FROM users WHERE email=:email');
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    /**
     * Creates a new session for the user if one doesn't exist
     *
     * @param string|int $userId
     * @param string $sessionId
     */
    public function registerSession($userId, $sessionId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('INSERT INTO user_sessions (user_id, session_id) VALUES (:userId, :sessionId)');
        $stmt->execute([
            'userId' => $userId,
            'sessionId' => $sessionId,
        ]);
    }

    /**
     * Checks that a users session is existing and not expired
     *
     * @param int|string $userId
     */
    public function doesSessionExistAndIsNotExpired($userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT * FROM user_sessions WHERE user_id =:userId');
        $stmt->execute(['userId' => $userId]);

        $userSession = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userSession;
    }

    /**
     * Adds a new user to the database
     *
     * @param \App\User\User $user
     * @return void
     */
    public function createUser($user)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare(
            'INSERT INTO users (email, password, name, gender, age, location)
            VALUES (:email, :password, :name, :gender, :age, :location)');
        $stmt->execute([
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'name' => $user->getName(),
            'gender' => $user->getGender(),
            'age' => $user->getAge(),
            'location' => $user->getLocation(),
        ]);
    }

    /**
     * Delete a specified user
     *
     * @param string|int $userId
     * @return void
     */
    public function deleteUser($userId)
    {
        $db = new DB();
        $conn = $db->connect();
        // Delete all records from other tables before this one, otherewise it will fail a foriegn key constraint
        $stmt = $conn->prepare('DELETE FROM users WHERE id=:id');
        $stmt->execute(['id' => $userId]);
    }

    /**
     * Find a user by their ID
     *
     * @param [type] $userId
     * @return void
     */
    public function findUserById($userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT * FROM users WHERE id=:id');
        $stmt->execute(['id' => $userId]);

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    /**
     * Checks that the passed token is equal to that stored
     *
     * @param string $token
     * @param string|int $userId
     * @return bool
     */
    public function verifySessionId($token, $userId)
    {

    }
}
