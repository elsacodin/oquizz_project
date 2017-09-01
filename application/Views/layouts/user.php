<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= APP_TITLE ?> - <?= $title ?></title>

    <link rel="stylesheet" href="<?=PUBLIC_PATH?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=PUBLIC_PATH?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=PUBLIC_PATH?>/css/styles.css">
</head>
<body>

<?=$this->insert('partials/header')?>

<main class="container">
    <section class="row">
        <div class="col-md-12">
            <h1>Mon compte</h1>
            <p>En tant que membre, vous pouvez répondre à tous les quizz et créer un nouveau quizz, qui sera accessible aux autres utilisateurs inscrits.</p>
        </div>
    </section>
    <?=$this->section('content')?>
</main>
<?=$this->insert('partials/footer')?>

    <script src="<?=PUBLIC_PATH?>/js/jquery.min.js"></script>
    <script src="<?=PUBLIC_PATH?>/js/bootstrap.min.js"></script>
    <script src="<?=PUBLIC_PATH?>/js/app.js"></script>
    <script>
        var config = {baseURL: '<?=BASE_PATH?>'};
    </script>
</body>
</html>
