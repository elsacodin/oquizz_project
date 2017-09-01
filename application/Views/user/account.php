<?php $this->layout('layouts/user', ['title' => $user->getFirstName()]) ?>

<section class="row">
    <div class="col-md-12">
        <h2>Bonjour <?=$user->getFullName() ?></h2>

        <!-- Quiz List by User -->
        <?php $this->insert('partials/quiz-list', ['quizzes' => $quizzes]) ?>
    </div>
</section>
