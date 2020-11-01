<?php


class Request {

    private $method;
    private $data;

    /**
     * Request constructor.
     * @param $method
     * @param $data
     */
    public function __construct($method, $data)
    {
        $this->method = $method;
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @param $method
     * @return mixed
     */
    public static function getData($method = 'GET')
    {
        $data = strtolower($method) == 'post' ? $_POST : $_GET;
        foreach ($data as $k => $d){
            $data[$k] = strip_tags($d);
        }
        return $data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Rerourne le nom de la page php exécuté
     * @return string
     */
    public static function requestPage(){
        // récupérer le nom de la page
        $url = explode('.php', $_SERVER['SCRIPT_NAME'])[0];
        $url = explode('/', $url);
        return $url[count($url) -1];
    }

    /**
     * Vérifier si l'utilisateur est connecté
     * @return bool
     */
    public static function isConnected(){
        return isset($_SESSION[APP_ID]) ? ($_SESSION[APP_ID] > 0) : false;
    }

    /**
     * Vérifier si l'administrateur est connecté
     * @return bool
     */
    public static function isAdminConnected(){
        return isset($_SESSION[APP_ADMIN_ID]) ? ($_SESSION[APP_ADMIN_ID] > 0) : false;
    }

}