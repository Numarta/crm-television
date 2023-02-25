<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceMaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Service Materials');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['service/index']];
$this->params['breadcrumbs'][] = ['label' => $service->title, 'url' => ['service/view', 'id' => $service->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-material-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Service Material'), ['create', 'id_service' => $service->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            			
			[
				'class' => 'yii\grid\SerialColumn', 				
				'options' => ['width' => '64'],
			],
            //'id',
            //'id_service',
            //'id_material',
			[
						'attribute' => 'id_material',			
						'filter' => ArrayHelper::map(app\models\Material::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'),
						'content' => function($data)
						{
							$var = $data->material;
							if (empty($var) == false)
								return $var->title;
							return NULL;
						},
			
					],   
			
			
            'amount',
            
			[
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{view} {update} {delete}',				
				'options' => ['width' => '70'],
			],
        ],
    ]); ?>
</div>
