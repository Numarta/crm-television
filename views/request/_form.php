<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    	
    <?= $form->field($model, 'order_date')->textInput() ?>

    <?= $form->field($model, 'order_number')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'paid')->checkbox() ?>

    <?= $form->field($model, 'id_executor')->dropDownList(ArrayHelper::map(app\models\User::find()->orderby(['last_name'=>SORT_ASC, 'first_name'=>SORT_ASC, 'middle_name'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
