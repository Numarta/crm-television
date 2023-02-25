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
			
			return '<div class="panel panel-info"><div class="panel-heading">' . $title . '</div><div class="panel-body">' . $body . '</div></div>';
		}

?>
<div class="service-view">

    <h1><?= Html::encode($this->title) ?></h1>			
	
	<?= MakeImageList ($model) ?>
	
	<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'title',
			'description',
            'cost',			
        ],
    ]) ?>
	
	<p>
		<?= Html::a(Yii::t('app', 'Add service to shopping cart'), ['request/add-service', 'id_service' => $model->id], ['class' => 'btn btn-primary', 'target'=>'_blank']) ?>
	</p>
	
	
	
	

</div>
