<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceImage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-image-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'description')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'id_image')->dropDownList(ArrayHelper::map(app\models\Image::find()->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
