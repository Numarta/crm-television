<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\RequestService */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-service-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'id_service')->dropDownList(ArrayHelper::map(app\models\Service::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
