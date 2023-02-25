<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequestService */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Request Service',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['request/index']];
$this->params['breadcrumbs'][] = ['label' => $request->title, 'url' => ['request/view', 'id' => $request->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Services'), 'url' => ['index', 'id_request' => $request->id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="request-service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
