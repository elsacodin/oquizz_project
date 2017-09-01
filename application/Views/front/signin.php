<?php $this->layout('layouts/default', ['title' => 'Connexion']) ?>

<?php if (isset($message)): ?>
    <p class="message">
        <?=$message; ?>
    </p>
<?php endif; ?>

<section class="row">
    <div id="signin-area" class="box col-md-6 col-md-offset-3">
        <h1>Connexion</h1>
        <?php var_dump($errors)?>

        <?php if(!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error) : ?>
                    <li><?=$error?></li>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form id="signin-form" action="<?= $router->generate('signin') ?>" method="POST">
            <div class="form-group">
                <label for="ff_email">Email</label>
                <input type="text" name="user[email]" class="form-control" id="ff_email" placeholder="Votre email...">
            </div>
            <div class="form-group">
                <label for="ff_pass">Mot de passe</label>
                <input type="password" name="user[password]" class="form-control" id="ff_pass" placeholder="Votre mot de passe...">
            </div>
            <p>Pas encore inscrit ? N'hésitez pas <a href="<?= $router->generate('signup') ?>">créer un compte</a></p>
            <button type="submit" name="sub" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</section>
