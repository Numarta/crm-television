<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reviews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Review'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	
	<div class="row">
		<div class="col-md-9">
			<?= ListView::widget([
				'dataProvider' => $dataProvider,
				'itemOptions' => ['class' => 'item'],
				'itemView' => function ($model, $key, $index, $widget) 		
				{			
					return $this->render('_item', [
							'model' => $model,
						]);	
				},
			]) ?>
		</div>
		<div class="col-md-3">
			<?php echo $this->render('_search', ['model' => $searchModel]); ?>
		</div>
	</div>

    <?php GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            			
			[
				'class' => 'yii\grid\SerialColumn', 				
				'options' => ['width' => '64'],
			],
            'id',
            'registration_date',
            'description:ntext',
            'id_user',
            'id_review_status',
            
			[
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{view} {update} {delete}',				
				'options' => ['width' => '70'],
			],
        ],
    ]); ?>
</div>
