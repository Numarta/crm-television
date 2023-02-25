<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ServiceMaterial */

$this->title = Yii::t('app', 'Create Service Material');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['service/index']];
$this->params['breadcrumbs'][] = ['label' => $service->title, 'url' => ['service/view', 'id' => $service->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Service Materials'), 'url' => ['index', 'id_service' => $service->id]];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-material-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
