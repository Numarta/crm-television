<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Document'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'registration_date',
            'title',
            'description:ntext',
            
			[
				'attribute' => 'id_document_type',		
				'filter' => ArrayHelper::map(app\models\DocumentType::find()->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->documentType;
					if (empty($var) == false)
						return $var->title;
					return '';
				},
			
			],   		
            //'file_name',
            //'size',          
			[
				'attribute' => 'id_user',		
				'filter' => ArrayHelper::map(app\models\User::find()->orderby(['last_name'=>SORT_ASC, 'first_name'=>SORT_ASC, 'middle_name'=>SORT_ASC])->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->user;
					if (empty($var) == false)
						return $var->title;
					return '';
				},
			
			],    
            /*
			[
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{view} {update} {delete}',				
				'options' => ['width' => '70'],
			],
			*/
			[
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{download} {view} {update} {delete}',
				'buttons' =>
					[
						'download'=>  function ($url, $model, $key)
						{							
							return Html::a('<span class="glyphicon glyphicon-download"></span>', ['document/download', 'id' => $model->id], ['title' => Yii::t('app', 'Download')]);
						},
					],	
				'options' => ['width' => '85'],
			 
			
			],
        ],
    ]); ?>
</div>
