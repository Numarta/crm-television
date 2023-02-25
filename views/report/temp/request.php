<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use miloschuman\highcharts\Highcharts;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Report Request');
$this->params['breadcrumbs'][] = $this->title;		

?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

			
			<?= DetailView::widget([
				'model' => $Settings,
				'attributes' => [
					'report_date_1:date',            
					'report_date_2:date',            			
				],
			]) ?>	
			
			<p>
				<?= Html::a(Yii::t('app', 'Update'), ['settings/update'], ['class' => 'btn btn-primary']) ?>        
			</p>
		
			<?php
			
				$gridColumns = [
            [
				'class' => 'yii\grid\SerialColumn',
				'options' => ['width' => '100'],
			],

			[
				'attribute' => 'title',
				'label' => 'Показатель',		
			],
			
			[
				'attribute' => 'value',
				'label' => 'Значение',
			],			
			
			
			];
			
			
			
				
				
				echo GridView::widget([
        'dataProvider' => $dataProvider,        
        'columns' => $gridColumns,


			
			
			]);
			
			echo ExportMenu::widget([
				'dataProvider' => $dataProvider,
				'columns' => $gridColumns
				]);
			
			
			
			?>
			
			<?php
			/*
				$data = $dataProvider->allModels;
				
				$categories = [];
				$created = [];
				$closed = [];
				$processing = [];
				
				for ($i = 0; $i < count ($data); $i ++)
				{
					$categories[] = \Yii::$app->formatter->asDate($data[$i]['date']);
					$created[] = $data[$i]['created'] + 0;
					$closed[] = $data[$i]['closed'] + 0;
					$processing[] = $data[$i]['processing'] + 0;					
				}
				
				echo Highcharts::widget([
					'options' => [
						'title' => ['text' => Yii::t('app', 'Common Report')],
						'xAxis' => [
							'categories' => $categories
						],
						'yAxis' => [
							'title' => ['text' => 'Количество заявок']
						],
						'series' => [
							['name' => 'Создано', 'data' => $created],
							['name' => 'Закрыто', 'data' => $closed],
							['name' => 'В работе', 'data' => $processing],
						], 
					]
				]);
			*/
			?>
		
	<div class="row">
		<div class="col-md-9">		
		</div>			
		<div class="col-md-3">
		</div>
	</div>
	
</div>
