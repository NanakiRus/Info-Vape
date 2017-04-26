<?php

namespace App\Routing;


class Router
{

    protected $routes = [];
    protected $host;
    protected static $url = '';
    protected $params = [];


    public function __construct($host = null)
    {
        $this->host = $host;

        if (null === $host) {
            $prot = explode('/', $_SERVER['SERVER_PROTOCOL']);
            $this->host = strtolower($prot[0]) . '://' . $_SERVER['SERVER_NAME'];
        }
    }

    public function add($name, $pattern, $controller, $action)
    {
        $this->routes[$name] = [
            'pattern' => $pattern,
            $controller => $action,
        ];

        return $this;
    }

    public function addArr($data = [])
    {
        $this->routes = array_merge($this->routes, $data);

        return $this;
    }

    public function splitUrl($url)
    {
        return preg_split('/\//', $url, -1, PREG_SPLIT_NO_EMPTY);
    }

    public function go($url = null)
    {
        if (null === $url) {
            $uri = reset(explode('?', $_SERVER['REQUEST_URI']));
            $url = urldecode(rtrim($uri, '/'));
        }

        self::$url = $url;

        $pattern = null;
        $item = null;
        foreach ($this->routes as $name => $array) {
            foreach ($this->routes[$name] as $key => $value) {
                if (false !== strpos($value, ':')) {
                    $data = str_replace(':any', '(.+)', str_replace(':num', '([0-9]+)', $value));
                }
                if (preg_match('~^' . $data . '$~', $url)) {
                    if (strpos($data, '(') !== false) {
                        $pattern = $data;
                    }
                    if (strpos($value, '$') !== false) {
                        $item = $value;
                    }
                    if (null !== $pattern && null !== $item) {
                        $value = preg_replace('#^' . $pattern . '$#', $item, $url);
                        $this->params = $this->splitUrl($value);
                        break;
                    }
                }
            }

        }

        foreach ($this->routes as $array) {
            if (in_array($url, $array)) {
                $this->params = $this->splitUrl($url);
                return $this->executeAction();
            }
            foreach ($array as $value) {
                $values = explode('/', trim($value, '/'));
                foreach ($values as $item) {
                    if (preg_match('~^\/' . $item . '$~', $url)) {
                        $this->params = $this->splitUrl($url);
                        return $this->executeAction();
                    }
                }
            }
        }
        return $this->executeAction();
    }

    public function executeAction()
    {
        var_dump($this->params);
//        if (isset($this->routes[$this->params[0]])) {
//
//        }
//        $controller = isset($this->routes[$this->params[0]]) ? $this->routes[$this->params[0]] : 'Category';
//        $action = isset(self::$params[1]) ? self::$params[1] : 'All';
//        $params = array_slice(self::$params, 2);
//
//        return call_user_func_array(array($controller, $action), $params);
    }
}