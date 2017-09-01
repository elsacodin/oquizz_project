<?php $this->layout('layouts/default', ['title' => 'Inscription']) ?>

<?php if (!empty($message)): ?>
    <p class="message">
        <?=$message; ?>
    </p>
<?php endif; ?>

<section class="row">
    <div class="box col-md-10 col-md-offset-1">
        <h1>Inscription</h1>
        <?php if (!empty($errors)): ?>
            <ul class="errors">
            <?php foreach ($errors as $error): ?>
                <li><?=$error ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="POST" action="<?= $router->generate('register') ?>" id="signup-form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ff_prenom">Prénom</label>
                        <input type="text" class="form-control" name="first_name" id="ff_prenom" placeholder="Votre prénom" value="<?=empty($data['first_name']) ? '' : $data['first_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="ff_nom">Nom</label>
                        <input type="text" class="form-control" name="last_name" id="ff_nom" placeholder="Votre nom" value="<?=empty($data['last_name']) ? '' : $data['last_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="ff_email">Email</label>
                        <input type="email" class="form-control" id="ff_email" name="email" placeholder="Votre email..." value="<?=empty($data['email']) ? '' : $data['email'] ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ff_pass">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="ff_pass" placeholder="Mot de passe d'un minimum de 8 caractères">
                    </div>
                    <div class="form-group">
                        <label for="ff_pass_confirm">Confirmation du mot de passe</label>
                        <input type="password" name="confirm_pass" class="form-control" id="ff_confirm_pass" placeholder="Confirmation">
                    </div>
                </div>
            </div>
            <button type="submit" name="signup_post" class="btn btn-primary">S'inscrire</button>
	    <p>Vous avez déjà un compte ? <a href="<?= $router->generate('signin') ?>">connectez-vous</a></p>
        </form>
    </div>
</section>
