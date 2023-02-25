<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = Yii::$app->params['projectName'];


function GetStatusTitle ($data)
				{
					$var = $data->status;					
					if ($var == app\models\User::STATUS_ACTIVE)
					{						
						return Yii::t('app', 'Active User');
					}					
					if ($var == app\models\User::STATUS_DELETED)
					{						
						return Yii::t('app', 'Deleted User');
					}		
					if ($var == app\models\User::STATUS_REGISTRED)
					{						
						return Yii::t('app', 'Registred User');
					}						
					return '';
				}

?>

<div class="site-index">

	<h1><?= Html::encode(Yii::t('app', 'User Data')) ?></h1>
	
	

	<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',            
			'last_name',   
			'first_name',   
			'middle_name',   
			'phone',   
            'email:email',  			
            'nikname',
			'username',    			
			[
				'attribute' => 'id_user_type',						
				'value' => empty ($model->idUserType) == false ? $model->idUserType->title : '',
			],   
			[
				'attribute' => 'status',						
				'value' => GetStatusTitle ($model),
			],   
		
           
        ],
    ]) ?>
	
	<p>		
        <?php //Html::a(Yii::t('app', 'Update'), ['user/update', 'id' => $model->id], ['class' => 'btn btn-primary']) 
		?>
    </p>
	
</div>
