<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



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
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?php if (Yii::$app->user->identity->IsAdmin) {?>
		<?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
		<?php } ?>
		<?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?php if (Yii::$app->user->identity->IsAdmin) {?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		<?php } ?>
    </p>
	
	
	
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
				'value' => GetStatusTitle ($model),
			],  
			'last_name',
            'first_name',
            'middle_name',
			'email:email',            
            'phone',
        ],
    ]) ?>
	

</div>
