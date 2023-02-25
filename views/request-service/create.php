<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RequestService */

$this->title = Yii::t('app', 'Create Request Service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['request/index']];
$this->params['breadcrumbs'][] = ['label' => $request->title, 'url' => ['request/view', 'id' => $request->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Services'), 'url' => ['index', 'id_request' => $request->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
