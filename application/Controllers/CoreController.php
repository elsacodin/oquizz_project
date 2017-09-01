<?php
namespace OQuiz\Controllers;

use OQuiz\Models\UserModel;
use \League\Plates\Engine as TemplateEngine;

abstract class CoreController
{
    protected $views;
    protected $router;
    protected $user;

    function __construct($router)
    {
        $this->router = $router;

        $this->generateTemplateEngine();
        $this->getCurrentUser();
        $this->initHook();
    }

    protected function initHook(){}

    public function redirect($route)
    {
        header('Location: '.$this->router->generate($route));
    }

    public function sendServerError($code = 500, $message = "Erreur")
    {
        header($message, true, $code);
        die($message);
    }

    private function generateTemplateEngine()
    {
        $this->views = new TemplateEngine('application/Views');
        $this->views->addData(['router'=>$this->router]);
    }

    private function getCurrentUser()
    {
        $this->user = new UserModel();

        if ($this->user->isLogged()) {
            $this->views->addData(['user' => $this->user]);
        }
    }

}
