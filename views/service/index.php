<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>
   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],			
            'title',			
			
            [
				'attribute' => 'cost',
				'options' => ['width' => '100'],					
			],			
			
			
            [
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{view} {buy}',
				'buttons' =>
					[
						'buy' =>  function ($url, $model, $key)
						{							
							return Html::a('<span class="glyphicon glyphicon-shopping-cart"/>', ['request/add-service', 'id_service' => $model->id], ['title' => Yii::t('app', 'Add service to shopping cart'), 'target'=>'_blank']);
						}
					],	
				'options' => ['width' => '50'],			
			],
        ],
    ]); ?>

</div>
