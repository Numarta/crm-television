<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Service */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

		function MakeImageList ($model)
		{
			$items = [];			
			foreach ($model->serviceImages as $image)
			{
				$data = [];
				$data['url'] = $image->idImage->ImageAddress;
				$data['src'] = $image->idImage->ThumbImageAddress;
				$data['options'] = ['title' => $image->title];
				$items[] = $data;
			}		
			
			$title = Yii::t ('app', 'Images');			
			if (count ($items) > 0)
				$body = dosamigos\gallery\Gallery::widget(['items' => $items]);
			else
				$body = Yii::t('app', 'Image List Empty');
			$footer = 
				Html::a(Yii::t('app', 'Image Loader'), ['image-loader/load', 'id_service' => $model->id], ['class' => 'btn btn-primary']) . ' ' . 
				Html::a(Yii::t('app', 'Service Images'), ['service-image/index', 'id_service' => $model->id], ['class' => 'btn btn-primary']);
			
			return '<div class="panel panel-info"><div class="panel-heading">' . $title . '</div><div class="panel-body">' . $body . '</div><div class="panel-footer">' . $footer . '</div></div>';
		}


?>
<div class="service-view">
	
	<h1><?= Html::encode($this->title) ?></h1>			
	
	<p>
		<?= Html::a(Yii::t('app', 'Create Service'), ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>		
		<?= Html::a(Yii::t('app', 'Service Materials'), ['service-material/index', 'id_service' => $model->id], ['class' => 'btn btn-success']) ?>
	</p>

		
	<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'title',
			'description',
            'cost',			
        ],
    ]) ?>
	
	<?= MakeImageList ($model) ?>
	
	
</div>
