<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Post;
use \App\Config;
use \App\Auth;
use \App\Flash;

/**
 * Posts controller
 *
 * PHP version 7.1
 */
class Posts extends Authenticated
{

    /**
     * Before filter - called before each action method
     *
     * @return void
     */
    protected function before()
    {
        parent::before();

        $this->user = Auth::getUser();
        $this->post = new Post();
    }

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
        View::renderWithLayout(Config::VIEWS_PATH . 'Posts/index.php', $posts);
    }

    /**
     * Show the add new page
     *
     * @return void
     * @throws \Exception
     */
    public function addNewAction()
    {
        View::renderWithLayout(Config::VIEWS_PATH . 'Posts/add.php');
    }

    /**
     * Update the profile
     *
     * @return void
     */
    public function updateAction()
    {
        if ($this->post->addPost($_POST)) {

            Flash::addMessage('Changes saved');

            $this->redirect('/posts/index');

        } else {

            View::renderWithLayout(Config::VIEWS_PATH . 'Posts/add.php');

        }
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
