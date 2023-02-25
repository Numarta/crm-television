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

$this->title = Yii::t('app', 'Customer Report');
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
				'options' => ['width' => '50'],
			],

			'last_name',
			'first_name',
			'middle_name',			
			'phone',
			'email',
			
			[
				'attribute' => 'id_user_type',				
				'filter' => ArrayHelper::map(app\models\UserType::find()->orderby(['title'=>'title asc'])->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idUserType;					
					if (empty($var) == false)
					{						
						return $var->title;
					}										
					return '';
				},
			
			],  
			
			[
				'attribute' => 'CustomerWorkingCustomCount',
				'label' => 'Заказано',
			],
			
			[
				'attribute' => 'CustomerCompletedCustomCount',
				'label' => 'Завершено',
			],
			/*
			
			[
				'attribute' => 'ManagerWorkingCustomCount',
				'label' => 'Заказов (Выполняется)',
				'contentOptions' => function($model)
                    {	
                        return ['style' => ['background'=>'Gray', 'color'=>'White']];
                    },
			],
			
			[
				'attribute' => 'ManagerCompletedCustomCount',
				'label' => 'Заказов (Выполнено)',
				'contentOptions' => function($model)
                    {	
                        return ['style' => ['background'=>'Gray', 'color'=>'White']];
                    },
			],		
			
						
			[
				'attribute' => 'ExecutorWorkingDiplomCount',
				'label' => 'ВКР (Выполнено)',
			],
			[
				'attribute' => 'ExecutorCompletedDiplomCount',
				'label' => 'ВКР (Выполняется)',
			],
			
			
			[
				'attribute' => 'ExecutorWorkingProjectCount',
				'label' => 'Курсовых (Выполняется)',
				'contentOptions' => function($model)
                    {	
                        return ['style' => ['background'=>'Gray', 'color'=>'White']];
                    },
			],
			[
				'attribute' => 'ExecutorCompletedProjectCount',
				'label' => 'Курсовых (Выполнено)',
				'contentOptions' => function($model)
                    {	
                        return ['style' => ['background'=>'Gray', 'color'=>'White']];
                    },
			],
			
			
			[
				'attribute' => 'ExecutorWorkingTestCount',
				'label' => 'Тестов (Выполняется)',
			],
			[
				'attribute' => 'ExecutorCompletedTestCount',			
				'label' => 'Тестов (Выполнено)',
			],
			
			[
				'attribute' => 'ExaminerWorkingTestCount',
				'label' => 'Тестов (Проверяеся)',
				'contentOptions' => function($model)
                    {	
                        return ['style' => ['background'=>'Gray', 'color'=>'White']];
                    },
			],			
			[
				'attribute' => 'ExaminerCompletedTestCount',
				'label' => 'Тестов (Проверено)',
				'contentOptions' => function($model)
                    {	
                        return ['style' => ['background'=>'Gray', 'color'=>'White']];
                    },
			],
			*/
			
			];

				echo GridView::widget([
		'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,   
		
        'columns' => $gridColumns
			]);
			
			
			echo ExportMenu::widget([
				'dataProvider' => $dataProvider,
				'columns' => $gridColumns
				]);			
			?>
			
			<?php
				/*
				$data = $dataProvider->query->all();
				
				$categories = [];
				$RequestCountSended = [];
				$RequestCountCreated = [];				
				$RequestCountWorking = [];
				$RequestCountWorked = [];
				
				for ($i = 0; $i < count ($data); $i ++)
				{
					$categories[] = $data[$i]->last_name . ' ' . $data[$i]->first_name . ' ' . $data[$i]->middle_name;
					$RequestCountSended[] = $data[$i]->RequestCountSended + 0;
					$RequestCountCreated[] = $data[$i]->RequestCountCreated + 0;
					$RequestCountWorking[] = $data[$i]->RequestCountWorking + 0;
					$RequestCountWorked[] = $data[$i]->RequestCountWorked + 0;					
				}
				
				echo Highcharts::widget([
					'options' => [
						'title' => ['text' => Yii::t('app', 'User Report')],
						'xAxis' => [
							'categories' => $categories
						],
						'yAxis' => [
							'title' => ['text' => 'Количество заявок']
						],
						'series' => [
							['name' => Yii::t('app', 'Request Count Sended'), 'data' => $RequestCountSended, 'type' => 'column'],
							['name' => Yii::t('app', 'Request Count Created'), 'data' => $RequestCountCreated, 'type' => 'column'],
							['name' => Yii::t('app', 'Request Count Working'), 'data' => $RequestCountWorking, 'type' => 'column'],
							['name' => Yii::t('app', 'Request Count Worked'), 'data' => $RequestCountWorked, 'type' => 'column'],							
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
