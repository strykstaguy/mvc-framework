<?php

namespace App\Controllers;

use \Core\View;
use \App\Config;

/**
 * Home controller
 *
 * PHP version 7.1
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     * @throws \Exception
     */
    public function indexAction()
    {
        View::renderWithLayout(Config::VIEWS_PATH . 'Home/index.php');
    }
}
