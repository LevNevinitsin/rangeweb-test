<?php
use yii\grid\GridView;
use yii\helpers\Url;

$host = Url::base(true);
?>
<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        [
            'attribute' => 'dateCreated',
            'headerOptions' => ['style' => 'width: 20%'],
        ],

        [
            'attribute' => 'sourceUrl',
            'headerOptions' => ['style' => 'width: 30%'],
        ],

        [
            'attribute' => 'shortUrl',

            'content' => function ($data) use ($host) {
                return "$host/$data->shortUrl";
            },

            'headerOptions' => ['style' => 'width: 30%'],
        ],

        [
            'attribute' => 'usesCount',
            'headerOptions' => ['style' => 'width: 10%'],
        ],
    ],
    'options' => ['class' => 'history-grid'],
    'pager' => [
        'disableCurrentPageButton' => true,
        'pageCssClass' => 'pagination-item',
        'activePageCssClass' => 'pagination-item--active',
        'linkOptions' => ['class' => 'link link--page'],
    ]
]) ?>
