<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\select2\Select2;


$this->title = Yii::t('app', 'Image Loader');

if (empty ($model->idService) == false)
{
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['service/index']];
	$this->params['breadcrumbs'][] = ['label' =>  $model->idService->title, 'url' => ['service/view', 'id' => $model->idService->id]];
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Service Images'), 'url' => ['service-image/index', 'id_service' => $model->idService->id]];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>   
		
	<?php $form = ActiveForm::begin([
				'method' => 'post',
				//'action' => ['controller/action'],
				'enableClientValidation' => false, 
				'options' => ['enctype' => 'multipart/form-data'],
			]); 
	?>	
	
	<?php $form->field($model, 'id_service')->dropDownList(ArrayHelper::map(app\models\Service::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>
	
	<?php // $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder'=>'Название для материала']) ?>
	
	<?php // $form->field($model, 'description')->textarea(['rows' => 5, 'placeholder'=>'Описание материала']) ?>
	
	
		
	<br>
		
	<?= FileInput::widget([
			'model' => $model,
			'attribute' => 'images[]',
			'options' => ['multiple' => true, 'accept' => 'image/*'], 
			'pluginOptions' => [
				'showPreview' => true,
				'showCaption' => true,
				'showRemove' => false,
				'showUpload' => true,
				'allowedFileExtensions' => ['jpg', 'gif', 'png'],
				//'uploadUrl' => Yii::$app->urlManager->createUrl (['/loader/image-loader-method']),
				],		
		]) 
	?>	
	
    <?php ActiveForm::end(); ?>
</div>
