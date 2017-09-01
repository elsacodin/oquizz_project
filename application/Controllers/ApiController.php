<?php

namespace OQuiz\Controllers;

class ApiController extends CoreController
{
  function __construct($router)
  {
    parent::__construct($router);

    if (!isAjax()) {
      $this->redirect('home');
    }
  }

  public function responseQuiz()
  {
    $data = [];
    for($i = 0; $i < 10; $i++) {
      if (isset($_GET[$i])) {
        $data[$i] = $_GET[$i];
      }

      if (empty($_GET[$i])) {
        $data[$i] = '';
      }
    }
    header('Content-Type: application/json');
    echo json_encode($data);
  }
}

 ?>
