<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Post;

/**
 * Posts controller
 *
 * PHP version 7.1
 */
class Posts extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction()
    {
        $posts = Post::getAll();

        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the add new page
     *
     * @return void
     * @throws \Exception
     */
    public function addNewAction()
    {
        $data = array();
        if(isset($_POST['submit'])) {
            $data = $_POST;
        }

        View::renderTemplate('Posts/add.html', [
            'data' => $data
        ]);
    }
    
    /**
     * Show the edit page
     *
     * @return void
     */
    public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<p>Route parameters: <pre>' .
             htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}
