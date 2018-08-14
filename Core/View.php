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
     * Render a view template using Twig
     *
     * @param string $template The template file
     * @param array $args Associative array of data to display in the view (optional)
     *
     * @return void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem('../App/Views');
            //$twig = new \Twig_Environment($loader);

            $twig = new \Twig_Environment($loader, array(
                'debug' => true,
            ));
            $twig->addExtension(new \Twig_Extension_Debug());
        }

        echo $twig->render($template, $args);
    }

    /**
     * Get the contents of a view template using Twig
     *
     * @param string $template The template file
     * @param array $args Associative array of data to display in the view (optional)
     *
     * @return string
     */
    public static function getTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig_Environment($loader);
            $twig->addGlobal('current_user', \App\Auth::getUser());
            $twig->addGlobal('flash_messages', \App\Flash::getMessages());
        }

        return $twig->render($template, $args);
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
            return include Config::VIEWS_PATH . "layout/main.php";
        } else {
            include $view;
        }

    }

}
