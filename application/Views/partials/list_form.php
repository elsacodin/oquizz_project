<?php $this->layout('layouts/default', ['title' => $title]) ?>
<main>


<div id="quiz">
  <h2 id="quiz-title">
    <?= $this->e($quiz->getTitle()) ?>
  </h2>
  <p>
    <?= count($questions) ?> questions
  </p>
</div>

<h3><?= $this->e($quiz->getDescription()) ?></h3>
<p>By : <?= $this->e($quiz->getAuthor()) ?></p>

<div class="col-xs-12">
  <div id="quiz-alert" class="alert alert-info" role="alert">Nouveau jeu: Répondez au maximum de questions avant de valider !</div>
</div>


<form id="quiz-form" action="<?= $router->generate('api_quiz')  ?>">

  <?php foreach ($questions as $key => $question) : ?>

    <div id="question-<?= $key ?>" class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">

            <!-- Level Question -->
            <?php if($this->e($question->getIdLevel()) == 1) : ?>
              <span class="btn-success">
                <?= $this->e($question->getLevel()) ?>
              </span>
            <?php elseif ($this->e($question->getIdLevel()) == 2) : ?>
              <span class="btn-warning">
                <?= $this->e($question->getLevel()) ?>
              </span>
            <?php else : ?>
              <span class="btn-danger">
                <?= $this->e($question->getLevel()) ?>
              </span>
            <?php endif; ?>

            <!-- Questions -->
            <?= $this->e($question->getQuestion()) ?>
          </h3>
        </div>

        <!-- Props -->
        <div class="panel-body">
        <ol>
          <!-- Get Mixed Props and display it -->
          <?php foreach($question->getMixedProps() as $value) : ?>
            <!-- If Prop1 exist... -->
            <?php if(isset($value['prop1'])) : ?>
              <li>
                <input type="radio" name="<?= $key ?>" id="<?= $value['prop1'] ?>" value="prop1">
                <label for="<?= $value['prop1'] ?>">
                  <?= $value['prop1'] ?>
                </label>
              </li>
            <?php elseif(isset($value['prop2'])) : ?>
              <li>
                <input type="radio" name="<?= $key ?>" id="<?= $value['prop2'] ?>" value="prop2">
                <label for="<?= $value['prop2'] ?>">
                  <?= $value['prop2'] ?>
                </label>
              </li>
            <?php elseif(isset($value['prop3'])) : ?>
              <li>
                <input type="radio" name="<?= $key ?>" id="<?= $value['prop3'] ?>" value="prop3">
                <label for="<?= $value['prop3'] ?>">
                  <?= $value['prop3'] ?>
                </label>
              </li>
            <?php elseif(isset($value['prop4'])) : ?>
              <li>
                <input type="radio" name="<?= $key ?>" id="<?= $value['prop4'] ?>" value="prop4">
                <label for="<?= $value['prop4'] ?>">
                  <?= $value['prop4'] ?>
                </label>
              </li>
            <?php endif; ?>
          <?php endforeach ?>
        </ol>
      </div>
      <div class="panel-footer hidden">
        <p><?= $this->e($question->getAnecdote()) ?></p>
        <a href="https://fr.wikipedia.org/wiki/<?= $this->e($question->getWiki()) ?>">Wikipedia : (<?= $this->e($question->getWiki()) ?>)</a>
      </div>
    </div>
  </div>

  <?php endforeach; ?>
    <button type="submit" class="col-xs-12 btn btn-primary" name="getResponse">Validez vos réponses</button>
  </form>
</main>
