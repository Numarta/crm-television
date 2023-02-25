<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'registration_date') ?>

    <?= $form->field($model, 'id_creator') ?>

    <?= $form->field($model, 'id_request_status') ?>

    <?= $form->field($model, 'order_date') ?>

    <?php // echo $form->field($model, 'order_number') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'id_executor') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
