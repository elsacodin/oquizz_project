<?php
namespace OQuiz\Controllers;

use OQuiz\Models\UserModel;
use OQuiz\Models\QuizModel;

/**
*
*/
class UserController extends CoreController
{
    /**
     * user profile
     *
     * @return void
     **/
    public function profileAction()
    {
        if (!$this->user->isLogged())
            $this->redirect('home');

        $quizzes = QuizModel::findByUser($this->user->getId());
        echo $this->views->render('user/account', [
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * sigin form page
     *
     * @return void
     **/
    public function signinAction()
    {
        $errors = [];
        if(!empty($_POST))
        {
            $userData = $_POST['user'];

            if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Votre Email n\'est pas conforme';
            }

            if (strlen($userData["password"]) < 8) {
                $errors[] = 'Le mot de passe doit contenir au moins 8 caractères';
            }

            if (!UserModel::auth($userData['email'],$userData['password'])) {
                $errors[] = 'Erreur d\'authentification';
            } else {
                // If not error on Auth, we're log.
                // So redirect > /profile/
                $this->redirect('profile');
            }
        }
        echo $this->views->render('front/signin', [
            'errors' => $errors,
        ]);
    }

    /**
     * signup form page
     *
     * @return void
     **/
    public function signupAction()
    {
        
        echo $this->views->render('front/signup');
    }

    /**
     * logout a user
     *
     * @return array - errors
     **/
    public function logoutAction()
    {
        $this->user->logout();
        $this->redirect('home');
    }

 /**
     * register a new user from signup form
     *
     * @return void
     **/
    public function registerAction()
    {
        $errors = $this->isValidRegistrationData($_POST);

        // Il y a des erreurs
        if ($errors) {
            $assignedData = [
                'message' => 'Erreur d\'enregistrement',
                'errors'=>$errors,
                'data'=>$_POST
            ];

            echo $this->views->render('front/signup', $assignedData);
            return;
        }

        //On essaye de créer le compte
        if (UserModel::register($_POST)) {
            $assignedData = ['message' => 'Compte créé, connectez-vous !'];

            echo $this->views->render('front/signin', $assignedData);
            return;
        }

        //Fallback - On retourne sur la page d'inscription
        $this->redirect('signup');
    }

    /**
     * analyze data for registration process
     *
     * @return array - errors
     **/
    private function isValidRegistrationData($data)
    {
        $errors = [];

        if (empty($data['first_name']))
            $errors[] = 'Votre prénom est obligatoire';

        if (empty($data['last_name']))
            $errors[] = 'Votre nom est obligatoire';

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $errors[] = 'Votre adresse email n\'est pas valide';

        if (UserModel::isEmailExists($data['email']))
            $errors[] = 'Cette adresse email existe déjà';

        if (!isset($data["password"]) || strlen($data["password"]) < 8)
            $errors[] = 'Le mot de passe doit contenir au moins 8 caractères';

        if (empty($data['confirm_pass']) || $data["password"] !== $data['confirm_pass'])
            $errors[] = 'Les mots de passe ne correspondent pas';

        return $errors;
    }
}
