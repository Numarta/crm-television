<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceMaterial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-material-form">

    <?php $form = ActiveForm::begin(); ?>
	



	
	<?= $form->field($model, 'id_material')->dropDownList(ArrayHelper::map(app\models\Material::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>
	

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
