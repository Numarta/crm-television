<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>
	

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
	
	
	<?php
	if ((Yii::$app->user->identity->IsAdmin || Yii::$app->user->identity->IsManager) && empty($model->id) == false)	{
	?>
	
	<?= $form->field($model, 'id_review_status')->dropDownList(ArrayHelper::map(app\models\ReviewStatus::find()->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>
	
	<?php
	}
	?>
	
	

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
