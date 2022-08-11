<?php

namespace App\Matcher;

use App\Database\DB;
use \PDO;
use PDOException;

class MatchRepository
{
    /**
     *
     */
    public function getAllMatches($userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT name, age, gender, location FROM users WHERE id != :userId');
        $stmt->execute(['userId' => $userId]);

        $sql = 'SELECT name, age, gender, location FROM users WHERE id != 1';

        $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $matches;
    }

    /**
     * Gets matches where users have swiped
     *
     * @param int $userId
     * @param int $matchId
     * @return void
     */
    public function doesMatchExist($userId, $matchId)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->prepare('SELECT * FROM user_matches WHERE user_id = :userId AND match_id = :matchId');
        $stmt->execute(['userId' => $userId, 'matchId' => $matchId]);
        $userMatchesWhereUserHasSwiped = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare('SELECT * FROM user_matches WHERE user_id = :matchId AND match_id = :userId');
        $stmt->execute(['userId' => $userId, 'matchId' => $matchId]);
        $userMatchesWhereMatchHasSwiped = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_merge($userMatchesWhereMatchHasSwiped, $userMatchesWhereUserHasSwiped);
    }

    /**
     * Create a match between two users
     *
     * @param int $userId
     * @param int $matchId
     * @param string $swipeDirection
     * @return void
     */
    public function createMatch($userId, $matchId, $swipeDirection)
    {
        try {
            $db = new DB();
            $conn = $db->connect();
            $stmt = $conn->prepare('INSERT INTO user_matches (user_id, match_id, user_swipe) VALUES (:userId, :matchId, :userSwipe)');
            $stmt->execute([
                'userId' => $userId,
                'matchId' => $matchId,
                'userSwipe' => $swipeDirection,
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        return true;
    }

    public function updateUserStatistics($matchId, $swipeDirection)
    {
        $db = new DB();
        $conn = $db->connect();
        $stmt = $swipeDirection === "YES"
            ? $conn->prepare('UPDATE user_statistics SET swipe_yes = swipe_yes + 1 WHERE user_id = :matchId')
            : $conn->prepare('UPDATE user_statistics SET swipe_no = swipe_no + 1 WHERE user_id = :matchId');

        $stmt->execute([
            'matchId' => $matchId
        ]);
    }

    public function updateMatch($userId, $matchId, $swipeDirection, $match)
    {
        $db = new DB();
        $conn = $db->connect();
        if ($match['user_swipe'] === null) {
            $stmt = $conn->prepare('UPDATE user_matches SET user_swipe = :swipeDirection WHERE match_id = :matchId');
            $stmt->execute(['swipeDirection' => $swipeDirection, 'matchId' => $matchId]);
        }
        if ($match['match_swipe'] === null) {
            $stmt = $conn->prepare('UPDATE user_matches SET match_swipe = :swipeDirection WHERE user_id = :matchId');
            $stmt->execute(['swipeDirection' => $swipeDirection, 'matchId' => $matchId]);
        }
    }
}

