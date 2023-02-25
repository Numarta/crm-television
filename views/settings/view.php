<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['view']];
?>
<div class="settings-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update'], ['class' => 'btn btn-primary']) ?>        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'report_date_1:date',
            'report_date_2:date',
        ],
    ]) ?>

</div>
