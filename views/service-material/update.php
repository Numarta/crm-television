<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceMaterial */

$this->title = Yii::t('app', 'Update Service Material: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['service/index']];
$this->params['breadcrumbs'][] = ['label' => $service->title, 'url' => ['service/view', 'id' => $service->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Service Materials'), 'url' => ['index', 'id_service' => $service->id]];

$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="service-material-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
