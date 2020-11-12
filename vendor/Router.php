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

    public function go(){
        if($this->getPath() != null && $this->getPath() != ""){
            header("location: ".$this->getPath());
            die("La page à été redirigé.");
            exit;
        }
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