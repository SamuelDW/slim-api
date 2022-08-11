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

    public function addAgeClause($age)
    {
        return 'WHERE users.age = $age';
    }

    public function addAttractiveClause($queryParams)
    {

    }

    public function addLocationClause($queryParams)
    {

    }


}
