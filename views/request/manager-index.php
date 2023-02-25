<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php 
			//echo Html::a(Yii::t('app', 'Create Request'), ['create'], ['class' => 'btn btn-success']) . ' ';
		?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
				'attribute' => 'id',
				'options' => ['width' => '75'],		
			],			
            'registration_date',            
			[
				'attribute' => 'id_creator',				
				'filter' => ArrayHelper::map(app\models\User::find()->orderby(['last_name'=>SORT_ASC, 'first_name'=>SORT_ASC, 'middle_name'=>SORT_ASC])->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idCreator;
					if (empty($var) == false)
						return $var->title;
					return '';
				},
			
			],    
            'cost',
			'paid:boolean',			
			[
				'attribute' => 'id_request_status',				
				'filter' => ArrayHelper::map(app\models\RequestStatus::find()->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idRequestStatus;
					if (empty($var) == false)
						return $var->title;
					return '';
				},
			],   		
			[
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{view}',				
				'options' => ['width' => '28'],			
			],
			
        ],
    ]); ?>

</div>
