<?php



use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
$this->title = Yii::$app->params['projectName'];

	function GetStatusTitle ($data)
				{
					$var = $data;					
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


	<h1><?= Html::encode($this->title) ?></h1>

	
	
	
	<?= DetailView::widget([
        'model' => $model,
        'attributes' => [    
			'username',            
            [
				'attribute' => 'id_user_type',						
				'value' => empty ($model->idUserType) == false ? $model->idUserType->title : null,
			],		
			[
				'attribute' => 'status',						
				'value' => GetStatusTitle ($model->status),
			],  
			'last_name',
            'first_name',
            'middle_name',
			'email:email',            
            'phone',
        ],
    ]) ?>
	
	<?php if (!empty(Yii::$app->user->identity)) {?>
    <p>		
		<?= Html::a(Yii::t('app', 'Update'), ['user/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
	<?php } ?>
	 

</div>