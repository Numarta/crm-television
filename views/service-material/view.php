<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceMaterial */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['service/index']];
$this->params['breadcrumbs'][] = ['label' => $service->title, 'url' => ['service/view', 'id' => $service->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Service Materials'), 'url' => ['index', 'id_service' => $service->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-material-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create Service Material'), ['create', 'id_service' => $service->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',            
			[				
				'attribute' => 'id_service',			
				'value' => empty ($model->service) == false ? $model->service->title : null,
			],     
			[				
				'attribute' => 'id_material',			
				'value' => empty ($model->material) == false ? $model->material->title : null,
			], 
            'amount',
        ],
    ]) ?>

</div>
