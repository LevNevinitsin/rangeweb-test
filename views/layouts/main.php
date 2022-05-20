<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap4\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="page-body">
<?php $this->beginBody() ?>

<header class="page-header">
    <nav class="page-header__navigation">
        <a class="page-header__link" href="<?= Url::to('/') ?>">Main page</a>
        <a class="page-header__link" href="<?= Url::to('/site/history') ?>">History</a>
    </nav>
</header>

<main role="main" class="page-main">
    <?= $content ?>
</main>

<footer class="page-footer">
    <p><?= date('Y') ?> (c) Lev Nevinitsin</p>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
