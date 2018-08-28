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
    protected $post;

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
        $posts = $this->post->getAllPosts();
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
     * Update the post
     *
     * @return void
     */
    public function updateAction()
    {
        //Adding New
        if (array_key_exists('add', $_POST)) {
            if ($this->post->addPost($_POST)) {

                Flash::addMessage('Post Added');

                $this->redirect('/posts/index');

            } else {

                View::renderWithLayout(Config::VIEWS_PATH . 'Posts/add.php');

            }
        //Edit Post
        } elseif (array_key_exists('edit', $_POST)) {
            if ($this->post->editPost($_POST)) {

                Flash::addMessage('Changes saved');

                $this->redirect('/posts/index');

            } else {

                View::renderWithLayout(Config::VIEWS_PATH . 'Posts/edit.php');

            }
        }

    }

    /**
     * Show the edit page
     *
     * @return void
     */
    public function editAction()
    {
        $post_id = $this->route_params['id'];
        $post = $this->post->findByID($post_id);

        View::renderWithLayout(Config::VIEWS_PATH . 'Posts/edit.php', [
            'post' => $post
        ]);

    }

    /**
     * View the post
     *
     * @return void
     */
    public function viewAction()
    {
        $post_id = $this->route_params['id'];
        $post = $this->post->findByID($post_id);
        View::renderWithLayout(Config::VIEWS_PATH . 'Posts/view.php', [
            'post' => $post
        ]);
    }

    /**
     * Delete the post
     *
     * @return void
     */
    public function deleteAction()
    {
        $post_id = $this->route_params['id'];

        if ($this->post->deletePost($post_id)) {

            Flash::addMessage('Post Deleted');

            $this->redirect('/posts/index');

        } else {

            Flash::addMessage('Unable to Delete Post');

            $this->redirect('/posts/index');

        }
    }
}
