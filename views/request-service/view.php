<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RequestService */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['request/index']];
$this->params['breadcrumbs'][] = ['label' => $request->title, 'url' => ['request/view', 'id' => $request->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Services'), 'url' => ['index', 'id_request' => $request->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-service-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?php 
			if ($editable)
			{
				echo Html::a(Yii::t('app', 'Create Request Service'), ['create', 'id_request' => $request->id], ['class' => 'btn btn-success']) . ' '; 
				echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) . ' ';
				echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
					'class' => 'btn btn-danger',
					'data' => [
							'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
							'method' => 'post',
						],
					]) . ' ';
			}		
		?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [				
				'attribute' => 'id_request',				
				'value' => empty ($model->idRequest) == false ? $model->idRequest->title : null,
			],     
            'registration_date',            
			[				
				'attribute' => 'id_service',				
				'value' => empty ($model->idService) == false ? $model->idService->title : null,
			],     
			'cost',
            'amount',            
			'total',            
        ],
    ]) ?>

</div>
