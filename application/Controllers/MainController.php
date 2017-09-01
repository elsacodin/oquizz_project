<?php
namespace OQuiz\Controllers;

use OQuiz\Models\QuizModel;
use OQuiz\Models\QuestionModel;

/**
*
*/
class MainController extends CoreController
{

    /**
     * home page
     *
     * @return void
     **/
    public function indexAction()
    {
        $quizzes = QuizModel::findAll();
        // echo "<pre>";
        // var_dump($quizzes);
        echo $this->views->render('front/home', [
            'title' => 'Bienvenue',
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * quiz page
     * @param array $params ($params['id'] : id of the quiz)
     */
    public function quizAction($params)
    {
        $id = intval($params['id'], 10);
        $quiz = QuizModel::find($id);
        $questions = QuestionModel::findByQuiz($id);

        $data = [
            'title' => $quiz->getTitle(),
            'quiz' => $quiz,
            'questions' => $questions
        ];

        if($this->user->isLogged()) {
          echo $this->views->render('partials/list_form', $data);
        } else {
          echo $this->views->render('front/quiz', $data);
        }
    }
}
