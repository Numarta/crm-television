<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ReviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>



    <?= $form->field($model, 'description') ?>

	<?php if (!empty(Yii::$app->user->identity)) { ?>
    
	<?php if (Yii::$app->user->identity->IsAdmin || Yii::$app->user->identity->IsManager) { ?>
    <?= $form->field($model, 'id_review_status')->dropDownList(ArrayHelper::map(app\models\ReviewStatus::find()->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>
	<?php } ?>
	
    <?= $form->field($model, 'my_review')->checkBox() ?>
	
	
	<?php } ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
