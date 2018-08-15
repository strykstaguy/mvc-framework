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
     * Error messages
     *
     * @var array
     */
    public $errors = [];

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

    /**
     * Find a post model by ID
     *
     * @param string $id The user ID
     *
     * @return mixed User object if found, false otherwise
     */
    public static function findByID($id)
    {
        $sql = 'SELECT * FROM posts WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Add a Post
     *
     * @param array $data Data from the add post form
     *
     * @return bool True if the data was added, false otherwise
     */
    public function addPost(array $data): bool
    {
        $this->title = $data['title'];
        $this->content = $data['content'];

        $this->validate();

        if (empty($this->errors)) {

            $sql = "INSERT INTO `posts` (`title`, `content`) VALUES (:title, :content)";

            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }

    /**
     * Edit a Post
     *
     * @param array $data Data from the edit post form
     *
     * @return bool True if the data was added, false otherwise
     */
    public function editPost(array $data): bool
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->content = $data['content'];

        $this->validate();

        if (empty($this->errors)) {

            $sql = "UPDATE `posts` SET `title` = :title, `content` = :content WHERE `id` = :id";

            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

            return $stmt->execute();
        }
        return false;
    }

    /**
     * Delete a Post
     *
     * @param array $data Data from the add post form
     *
     * @return bool True if the post was deleted, false otherwise
     */
    public function deletePost($id): bool
    {
        $sql = "DELETE FROM `posts` WHERE `id` = :id";
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $response = $stmt->execute();
        return $response;
    }

    /**
     * Validate current property values, adding valiation error messages to the errors array property
     *
     * @return void
     */
    public function validate()
    {
        // Title
        if ($this->title == '') {
            $this->errors[] = 'Title is required';
        }

        // Content
        if ($this->content == '') {
            $this->errors[] = 'Content is required';
        }

    }
}
