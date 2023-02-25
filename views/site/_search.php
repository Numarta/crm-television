<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
		//'type' => ActiveForm::TYPE_INLINE,			
    ]); ?>    
	
	<?= $form->field($model, 'id_object')->dropDownList(ArrayHelper::map(app\models\Object::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>
	
	<?= $form->field($model, 'id_product')->dropDownList(ArrayHelper::map(app\models\Product::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>
		
	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'solution')->textInput() ?>


    <div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
