<?php

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
     *
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
     *
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

    public function deleteUser($userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('DELETE FROM users WHERE id=:id');
        $stmt->execute(['id' => $userId]);
    }

    public function findUserById($userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT * FROM users WHERE id=:id');
        $stmt->execute(['id' => $userId]);

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
}
