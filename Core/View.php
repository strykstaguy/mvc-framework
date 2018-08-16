<?php

namespace Core;

use \App\Config;

/**
 * View
 *
 * PHP version 7.1
 */
class View
{

    /**
     * Render a view file
     *
     * @param string $view The view file
     * @param array $args Associative array of data to display in the view (optional)
     *
     * @return void
     * @throws \Exception
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view";  // relative to Core directory

        $current_user = \App\Auth::getUser();
        $flash_messages = \App\Flash::getMessages();

        $flash = '';
        if (isset($flash_messages)) {
            foreach ($flash_messages as $message) {
                //$message['type']
                $flash = "<div class=\"alert alert-\"> ";
                $flash .= $message['body'];
                $flash .= "</div> ";
            }
        }

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
     * Render a view file
     *
     * @param string $view The view file
     * @param array $data Associative array of data to display in the view (optional)
     * @param boolean $layout if you want the view to be rendered with
     *
     * @return string Rendered View
     */
    public static function renderWithLayout($view, $data = null, $layout = true)
    {
        if (isset($data)) {
            extract($data);
        }

        $current_user = \App\Auth::getUser();
        $flash_messages = \App\Flash::getMessages();

        $flash = '';
        if (isset($flash_messages)) {
            foreach ($flash_messages as $message) {
                //$message['type']
                $flash = "<div class=\"alert alert-\"> ";
                $flash .= $message['body'];
                $flash .= "</div> ";
            }
        }

        if ($layout) {
            include Config::VIEWS_PATH . "layout/main.php";
        } else {
            include $view;
        }

    }

}
