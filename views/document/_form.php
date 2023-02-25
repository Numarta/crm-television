<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form">

    <?php $form = ActiveForm::begin([
				'method' => 'post',				
				'enableClientValidation' => false, 
				'options' => ['enctype' => 'multipart/form-data']]); ?>
	

  

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'id_document_type')->dropDownList(ArrayHelper::map(app\models\DocumentType::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>

   <?= FileInput::widget([
			'model' => $model,
			'attribute' => 'file',
			'options' => ['multiple' => false, 'accept' => '*/*'], 
			'pluginOptions' => [
				'showPreview' => !true,
				'showCaption' => true,
				'showRemove' => false,
				'showUpload' => true,
				//'allowedFileExtensions' => ['jpg', 'gif', 'png'],				
				],		
		]) ?>
		
	<br>

    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
