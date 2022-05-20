<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div>
    <?php $form = ActiveForm::begin([
        'id' => 'request-form',
        'action' => '/',
        'method' => 'post',
        'validateOnBlur' => false,
        'validateOnChange' => false,
        'options' => [
            'class' => 'form',
        ],
    ]) ?>
        <?= $form->field($model, 'sourceUrl', ['inputOptions' => ['class' => 'js-source-url']])->textInput() ?>

        <?= Html::submitButton('Submit', ['class' => 'button js-submit']); ?>
    <?php $form = ActiveForm::end() ?>
</div>

<div>
    <p class="result-caption">Short URL</p>

    <p class="result js-result"></p>
</div>
