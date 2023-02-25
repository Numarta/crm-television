<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\select2\Select2;


$this->title = Yii::t('app', 'Image Loader Result');

if (empty ($service) == false)
{
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['service/index']];
	$this->params['breadcrumbs'][] = ['label' =>  $service->title, 'url' => ['service/view', 'id' => $service->id]];
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Service Images'), 'url' => ['service-image/index', 'id_service' => $service->id]];
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Image Loader'), 'url' => ['image-loader/load', 'id_service' => $service->id]];
}
else
{
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Image Loader'), 'url' => ['image-loader/load']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-loader-result">

    <h1><?= Html::encode($this->title) ?></h1>   	
	
	<?php
		//		
		for ($i = 0; $i < count($result); $i ++)
		{
			//
			echo ($i + 1) . '. ' . $result[$i]['message'] . ' (' . $result[$i]['file_name'] . ')<br>';
		}		
	?>
	
	
	
	
   
    

</div>
