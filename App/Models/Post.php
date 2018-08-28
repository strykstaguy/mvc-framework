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

    protected $db;

    public function __construct()
    {
        $this->db = $this->getDatabase();
    }

    /**
     * Get all the posts as an associative array
     *
     * @return array
     */
    public function getAllPosts()
    {
        try {

            $query  = "SELECT posts.id AS id, posts.title, posts.content ";
            $query .= "FROM posts ";
            $query .= "ORDER BY posts.created_at DESC ";
            $this->query($query);
            $this->execute();

            $results = $this->fetchAllAssociative();

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
    public function findByID($id)
    {
        $query = 'SELECT * FROM posts WHERE id = :id';

        $this->query($query);
        $this->bindValue(':id', $id, PDO::PARAM_INT);
        $this->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $this->execute();

        return $this->fetchClass();
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

            $query = "INSERT INTO `posts` (`title`, `content`) VALUES (:title, :content)";
            $this->query($query);
            $this->bindValue(':title', $this->title, PDO::PARAM_STR);
            $this->bindValue(':content', $this->content, PDO::PARAM_STR);

            return $this->execute();
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

            $query = "UPDATE `posts` SET `title` = :title, `content` = :content WHERE `id` = :id";

            $this->query($query);
            $this->bindValue(':title', $this->title, PDO::PARAM_STR);
            $this->bindValue(':content', $this->content, PDO::PARAM_STR);
            $this->bindValue(':id', $this->id, PDO::PARAM_INT);

            return $this->execute();
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
        $query = "DELETE FROM `posts` WHERE `id` = :id";
        $this->query($query);
        $this->bindValue(':id', $id, PDO::PARAM_INT);

        $response = $this->execute();
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
