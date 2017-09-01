<?php $this->layout('layouts/default', ['title' => $title]) ?>

<section class="row">
    <div class="col-md-12">
        <h1>Bienvenue sur le 1er site de quizz participatif</h1>

        <p>Pour jouer, ou créer votre propre quizz et enrichir ce site collaboratif, inscrivez vous. A vous de jouer!</p>

        <!-- All Quiz list -->
        <?php $this->insert('partials/quiz-list', ['quizzes' => $quizzes]) ?>
    </div>
</section>
