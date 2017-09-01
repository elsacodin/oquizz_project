# O'Quiz
This is a quizz application made during my O'Clock training as a PHP-OOP-MVC project. Work in process: admin features not achieved yet.

## Description
Visitors can view all the quizzes and read the questions (3 levels) but they must be logged-in to be able to play and check the answers. (dev: +create a new quizz).

Sitemap
```
 /              home
|_  /signup/    inscription
|_  /signin/    connexion
|_  /quiz/      page d'un quiz (consulter ou jouer)
|_  /compte/    profil membre (connecté)
```

## Install
* Import Database structure and content in your DB tool. (`sql/oquiz-struct.sql`&`sql/oquiz-data.sql`).
* `composer install`
* create your own config file `application/config.php` from the model provided (config_dist.php)
