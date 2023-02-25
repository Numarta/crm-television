<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    
    <div class="row">
        <div class="col-lg-3">
		</div>
		<div class="col-lg-6">	
			<h1><?= Html::encode($this->title) ?></h1>

			<p><?= Yii::t('app', 'Please fill out your email. A link to reset password will be sent there.') ?></p>

            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email') ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
		<div class="col-lg-3">
		</div>
    </div>
</div>
