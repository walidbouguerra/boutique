<?php
namespace Boutique\App;
use AltoRouter;
class Router
{
    protected $router;
    protected $match;
    protected $controller;
    protected $method;


    public function __construct()
    {
        $this->router = new AltoRouter();
    }

    public function get(string $url, string $appel, string $name = null): self
    {
        $this->router->map('GET', $url, $appel, $name);
        return $this;
    }

    public function post(string $url, string $appel, string $name = null): self
    {
        $this->router->map('POST', $url, $appel, $name);
        return $this;
    }

    public function run()
    {
        $match = $this->router->match();

        if (is_array($match) && is_callable($match['target']) . 'Controller') {
            list($controller, $action) = explode('#', $match['target']);

            $ctrl = '\Boutique\Controllers\\' . ucfirst($controller) . 'Controller';

            $controller = new $ctrl;

            call_user_func_array(array($controller, $action), array($match['params']));
        }
    }
}