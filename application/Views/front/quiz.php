<?php $this->layout('layouts/default', ['title' => $title]) ?>

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

<?php foreach ($questions as $question) :
?>

  <div class="col-xs-12 col-sm-6 col-md-4">

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
        <?php foreach($question->getMixedProps() as $key => $value) : ?>
          <?php if(isset($value['prop1'])) : ?>
            <li><?= $value['prop1'] ?></li>
          <?php elseif(isset($value['prop2'])) : ?>
            <li><?= $value['prop2'] ?></li>
          <?php elseif(isset($value['prop3'])) : ?>
            <li><?= $value['prop3'] ?></li>
          <?php elseif(isset($value['prop4'])) : ?>
            <li><?= $value['prop4'] ?></li>
          <?php endif; ?>
        <?php endforeach ?>
      </ol>
    </div>
  </div>
</div>

<?php endforeach; ?>
