<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>
	
	<p>
		<?php 			
			
			switch ($model->id_request_status)
			{			
				
				case \app\models\Request::REQUEST_STATUS_OPEN :
				{
					echo Html::a(Yii::t('app', 'Request Full'), ['request/request-full', 'id_request' => $model->id], ['class' => 'btn btn-success', 'data' => ['confirm' => Yii::t('app', 'Выполнить операцию?'), 'method' => 'post']]) . ' '; 
				} break;
				
				case \app\models\Request::REQUEST_STATUS_FULL :
				{	
					if ($model->paid == false)
					{
						echo Html::a(Yii::t('app', 'Request Paid'), ['request/request-paid', 'id_request' => $model->id], ['class' => 'btn btn-success', 'data' => ['confirm' => Yii::t('app', 'Выполнить операцию?'), 'method' => 'post']]) . ' '; 					
					}
					else
					{
						echo Html::a(Yii::t('app', 'Request Performing'), ['request/request-performing', 'id_request' => $model->id], ['class' => 'btn btn-success', 'data' => ['confirm' => Yii::t('app', 'Выполнить операцию?'), 'method' => 'post']]) . ' '; 					
					}
				} break;

				case \app\models\Request::REQUEST_STATUS_PERFORMING :
				{
					echo Html::a(Yii::t('app', 'Request Performed'), ['request/request-performed', 'id_request' => $model->id], ['class' => 'btn btn-success', 'data' => ['confirm' => Yii::t('app', 'Выполнить операцию?'), 'method' => 'post']]) . ' '; 
				} break;
				
				case \app\models\Request::REQUEST_STATUS_PERFORMED :
				{
					
				} break;
				
			}
		?>      
    </p>		
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'registration_date',            
			[				
				'attribute' => 'id_creator',					
				'value' => empty ($model->idCreator) == false ? $model->idCreator->title : null,
			],                   
			[				
				'attribute' => 'id_request_status',				
				'value' => empty ($model->idRequestStatus) == false ? $model->idRequestStatus->title : null,
			],     		
            'cost',
			'paid:boolean',
			[				
				'attribute' => 'id_executor',					
				'value' => empty ($model->idExecutor) == false ? $model->idExecutor->title : null,
			],       
        ],
    ]) ?>
	
	
	
	<p>	
        
        <?php 
			if ($editable)
				echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
					'method' => 'post',
				],
			]) . ' '; 
		?>
		<?= Html::a(Yii::t('app', 'Request Services'), ['request-service/index', 'id_request' => $model->id], ['class' => 'btn btn-primary'/*, 'target'=>'_blank'*/]) ?>
		<?= Html::a(Yii::t('app', 'Report Request'), ['report/request', 'id_request' => $model->id], ['class' => 'btn btn-primary'/*, 'target'=>'_blank'*/]) ?>
    </p>

</div>
