<?php
namespace OQuiz;

use \AltoRouter as Router;
use \League\Plates\Engine as TemplateEngine;

class App
{
    private $router;

    function __construct()
    {
        $this->router = new Router();
        $this->router->setBasePath(BASE_PATH);

        $this->defineRoutes();
    }

    private function defineRoutes()
    {
        $this->router->map('GET','/', 'Main#indexAction', 'home');

        $this->router->map('GET|POST', '/signin/', 'User#signinAction', 'signin');
        $this->router->map('GET', '/logout/', 'User#logoutAction', 'logout');

        $this->router->map('GET', '/signup/', 'User#signupAction', 'signup');
        $this->router->map('POST', '/register/', 'User#registerAction', 'register');

        $this->router->map('GET', '/compte/', 'User#profileAction', 'profile');

        // /route/[id]
        $this->router->map('GET', '/quiz/[i:id]', 'Main#quizAction', 'quiz');
        $this->router->map('GET', '/api/quiz/', 'Api#responseQuiz', 'api_quiz');
    }

    public function run()
    {
        $match = $this->router->match();
        $target = explode("#", $match["target"]);
        $controllerName = 'OQuiz\\Controllers\\' . $target[0] . 'Controller';
        $params = $match['params'];
        $action = isset($target[1]) ? $target[1] : 'indexAction';

        if (class_exists($controllerName)) {
            $controller = new $controllerName($this->router);

            if (method_exists($controller, $action))
                return call_user_func([$controller, $action], $params);
        }

        return $this->routeError();
    }

    private function routeError($error = 404) {
        $view = new TemplateEngine('application/Views');
        echo $view->render('error/'.$error);
        exit();
    }

}
