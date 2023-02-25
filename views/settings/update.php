<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['view']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="settings-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
