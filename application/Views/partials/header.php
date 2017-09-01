<header>
    <nav class="navbar">
        <div class="container">
            <a id="logo" class="navbar-brand" href="<?=$router->generate('home')?>">
                O'Quiz
            </a>
            <ul class="nav nav-pills navbar-right">
                <?php if (isset($user)): ?>
                    <li><a href="<?=$router->generate('profile')?>">Bonjour <strong><?=$user->getFirstName() ?></strong></a></li>
                <?php endif; ?>
                <li <?=($router->match()['name'] == 'home')?'class="active"':''?>>
                    <a href="<?=$router->generate('home')?>">
                        <span class="fa fa-home"></span> Accueil</a>
                </li>
                <?php if (isset($user)): ?>
                    <li <?=($router->match()['name'] == 'profile')?'class="active"':''?>>
                        <a href="<?=$router->generate('profile')?>"><span class="fa fa-user"></span> Mon compte</a>
                    </li>
                    <li <?=($router->match()['name'] == 'logout')?'class="active"':''?>>
                        <a href="<?=$router->generate('logout')?>"><span class="fa fa-sign-out"></span> Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li <?=($router->match()['name'] == 'signup')?'class="active"':''?>>
                        <a href="<?=$router->generate('signup')?>"><span class="fa fa-edit"></span> Inscription</a>
                    </li>
                    <li <?=($router->match()['name'] == 'signin')?'class="active"':''?>>
                        <a href="<?=$router->generate('signin')?>"><span class="fa fa-sign-in"></span> Connexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
