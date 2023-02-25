<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Client'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'client_id',
            //'client_secret',
            'redirect_uri:ntext',
            
			[
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{view} {update} {delete}',				
				'options' => ['width' => '70'],
			],
        ],
    ]); ?>
</div>
