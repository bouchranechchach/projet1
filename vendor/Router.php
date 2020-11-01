<?php

class Router {

    private $path;

    /**
     * Router constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Redirection vers une page
     * @param $page
     * @param string $params
     */
    public static function redirect($page, $params = ''){
        global $main_folder;
        $params = $params == '' ? '' : "?$params";
        header("location: ".$main_folder."$page.php$params");
        die("La page à été redirigé.");
        exit;
    }

}