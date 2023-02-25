<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Grant Access');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
   

    <div class="row">
		<div class="col-lg-4">
		</div>
        <div class="col-lg-4">
			<h1><?= Html::encode($this->title) ?></h1>

			<p><?= Yii::t('api', 'Grant "{site}" access to your data?', ['site' => '<b>' . $client->client_id . '</b>']) ?></p>
            <?php $form = ActiveForm::begin(['id' => 'grant-access-form']); ?>
  

                <?= $form->field($model, 'answer')->checkbox() ?>

            
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'OK'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
		<div class="col-lg-4">
		</div>
    </div>
</div>
