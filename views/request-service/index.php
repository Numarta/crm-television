<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Request Services');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['request/index']];
$this->params['breadcrumbs'][] = ['label' => $request->title, 'url' => ['request/view', 'id' => $request->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="request-service-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php 
			if ($editable)
			{
				echo Html::a(Yii::t('app', 'Create Request Service'), ['create', 'id_request' => $request->id], ['class' => 'btn btn-success']) . ' '; 				
			}		
		?>
    </p>

    <?php
		
			echo GridView::widget([
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],
					//'id',
					//'id_request',
					'registration_date',
					[
						'attribute' => 'id_service',				
						'filter' => ArrayHelper::map(app\models\Service::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'),
						'content' => function($data)
						{
							$var = $data->idService;
							if (empty($var) == false)
								return $var->title;
							return NULL;
						},
			
					],   
					'cost',
					'amount',            
					'total',
					// 'description:ntext',
					[
						'class' => 'yii\grid\ActionColumn', 
						'template' => $editable ? '{view} {update} {delete}' : '{view}',				
						'options' => ['width' => '68'],			
					],
				],
			]); 
		
	?>

</div>
