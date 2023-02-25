<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

use kartik\touchspin\TouchSpin


/* @var $this yii\web\View */
/* @var $model app\models\RoomImage */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="news-item">



	<?php 
		$class = 'panel panel-default';
		
		switch ($model->id_review_status) {
			case 1 : 
				$class = 'panel panel-info';
			break;
			
			case 2 : 
				$class = 'panel panel-warning';
			break;
			
			case 3 : 
				$class = 'panel panel-danger';
			break;
			
			case 4 : 
				$class = 'panel panel-default';
			break;
			
		}
		
	?>
	

	<div class="<?= $class ?>">
		<div class="panel-heading">		
			<h3 class="panel-title"><b><?= Html::encode($model->title) ?></b><p class="pull-right"><b><?= \Yii::$app->formatter->asDate($model->registration_date); ?></b></p></h3>
		</div>
		<div class="panel-body text-justify">
			
			<?= nl2br($model->description) ?>					
			
		</div>
		
		
		<?php if (!empty(Yii::$app->user->identity)) { ?>			
		<?php if (Yii::$app->user->identity->IsAdmin || Yii::$app->user->identity->IsManager) { ?>
		
		<div class="panel-footer">					
			<?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->id], ['title' => Yii::t('app', 'View')]) ?>
			<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], ['title' => Yii::t('app', 'Update')]) ?>
			<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		</div>				
		
		<?php } ?>
		<?php } ?>
	</div>

</div>
