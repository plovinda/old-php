<?php

class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {

        /*
         *  At first it takes the URL in the GET request and parses it. It instantiates the controller object and includes the
         * controller class, the method class and calls the user function in the specific controller class with the parameters given.
         * */
        $url = $this->parseUrl();
        if(file_exists('../app/controllers/'.$url[0].'.php'))
        {
            $this->controller = $url[0];
            unset($url[0]);
        }
        require_once '../app/controllers/'.$this->controller.'.php';
        $this->controller = new $this->controller;

        if(isset($url[1])) {
            if (method_exists($this->controller, $url[1]))
            {
               $this->method = $url[1];
               unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller,$this->method],$this->params);
    }
    /*
     * Takes a URL, removes the '/' in the right and sanitises the URL. sanitise means remove unwanted characters in the URL and
     * explode it into an array. The array now will contain the name of the controller as the first element, the method name as
     * the second element, the parameters as the third element and returns the URL array.
     *
     * If URL is empty, it instantiates the default controller.
     * */
    public function parseUrl() {

        if(isset($_GET['url'])) {
           return $url = explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
        }
        require_once '../app/controllers/'.$this->controller.'.php';
    }
}