<!-- Quiz List -->
<?php foreach ($quizzes as $quiz) : ?>
<div class="col-xs-12 col-sm-6 col-md-4">
  <div class="row">
  <a href="<?= $router->generate('quiz', ['id' => $quiz->getId()]) ?>">
    <h3><?= $this->e($quiz->getTitle()) ?></h3>
  </a>
  <p>
    <strong>
      <?= $this->e($quiz->getDescription()) ?>
    </strong>
  </p>
  <p>
    By <?= $this->e($quiz->getAuthor()) ?>
  </p>
</div>
</div>

<?php endforeach; ?>
