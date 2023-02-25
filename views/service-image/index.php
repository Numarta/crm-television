<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Service Images');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['service/index']];
$this->params['breadcrumbs'][] = ['label' => $service->title, 'url' => ['service/view', 'id' => $service->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Service Image'), ['create', 'id_service' => $service->id], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'Image Loader'), ['image-loader/load', 'id_service' => $service->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
				'class' => 'yii\grid\SerialColumn',
				'options' => ['width' => '68'],
			],
                        
            'title',
            //'description:ntext',		
			
			[
				'attribute' => 'id_image',				
				'format' => 'raw',
				'filter' => ArrayHelper::map(app\models\Image::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idImage;
					if (empty($var) == false)
						return '<div align="center">' . Html::img ($var->ThumbImageAddress) . '</div>';
					return NULL;
				},
				'options' => ['width' => '150'],	
			],                 

            [
				'class' => 'yii\grid\ActionColumn',
				'options' => ['width' => '68'],
			],
        ],
    ]); ?>

</div>
