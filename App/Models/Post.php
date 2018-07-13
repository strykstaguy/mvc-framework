<?php

namespace App\Models;

use PDO;
use Core\Database;
/**
 * Post model
 *
 * PHP version 7.1
 */
class Post extends \Core\Model
{

    /**
     * Get all the posts as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        try {

            $database   = Database::openConnection();
            $query  = "SELECT posts.id AS id, posts.title, posts.content ";
            $query .= "FROM posts ";
            $query .= "ORDER BY posts.created_at DESC ";
            //$query .= "LIMIT $limit OFFSET $offset";
            $database->prepare($query);
            $database->execute();
            $results = $database->fetchAllAssociative();
            $database->closeConnection();

            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
