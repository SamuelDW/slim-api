<?php

namespace App\Profiles;

use App\Database\DB;
use \PDO;

class ProfileRepository
{
    public function getAllProfiles($userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT name, age, gender, location FROM users WHERE id != :userId');
        $stmt->execute(['userId' => $userId]);

        $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profiles;
    }

    public function getUsersWithAge($age, $userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT name, age, gender, location FROM users WHERE id != :userId AND age = :age');
        $stmt->execute([
            'userId' => $userId,
            'age' => $age,
        ]);

        $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profiles;
    }

    public function getUsersByGender($gender, $userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT name, age, gender, location FROM users WHERE id != :userId AND gender = :gender');
        $stmt->execute([
            'userId' => $userId,
            'gender' => $gender,
        ]);

        $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profiles;
    }

    public function getUsersByGenderAndAge($age, $gender, $userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT name, age, gender, location FROM users WHERE id != :userId AND age = :age AND gender = :gender');
        $stmt->execute([
            'userId' => $userId,
            'age' => $age,
            'gender' => $gender,
        ]);

        $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profiles;
    }

    public function getUsersByAttractiveness($attractiveness, $userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT users.ame, users.age, users.gender, users.location FROM users INNER JOIN user_matches ON user_matches.user_id = users.id WHERE users.id != :userId AND user_matches.attract_rating = :attractiveness');
        $stmt->execute([
            'userId' => $userId,
            'attractiveness' => $attractiveness
        ]);

        $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profiles;
    }

    public function addLocationClause($queryParams)
    {

    }


}
