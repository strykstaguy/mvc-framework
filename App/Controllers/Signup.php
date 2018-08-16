<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Config;

/**
 * Signup controller
 *
 * PHP version 7.0
 */
class Signup extends \Core\Controller
{

    /**
     * Show the signup page
     *
     * @return void
     */
    public function newAction()
    {
        View::renderWithLayout(Config::VIEWS_PATH . 'Signup/new.php');
    }

    /**
     * Sign up a new user
     *
     * @return void
     */
    public function createAction()
    {
        $user = new User($_POST);

        if ($user->save()) {

            $user->sendActivationEmail();

            $this->redirect('/signup/success');

        } else {

            View::renderWithLayout(Config::VIEWS_PATH . 'Signup/new.php', [
                'user' => $user
            ]);

        }
    }

    /**
     * Show the signup success page
     *
     * @return void
     */
    public function successAction()
    {
        View::renderWithLayout(Config::VIEWS_PATH . 'Signup/success.php');
    }

    /**
     * Activate a new account
     *
     * @return void
     */
    public function activateAction()
    {
        User::activate($this->route_params['token']);

        $this->redirect(Config::VIEWS_PATH . '/signup/activated');
    }

    /**
     * Show the activation success page
     *
     * @return void
     */
    public function activatedAction()
    {
        View::renderWithLayout(Config::VIEWS_PATH . 'Signup/activated.php');
    }
}
