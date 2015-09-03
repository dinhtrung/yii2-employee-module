<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model hellobyte\employee\models\ECertificate */

$this->title = $model->degree;
$this->params['breadcrumbs'][] = ['label' => Yii::t('hellobyte', 'Ecertificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ecertificate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('hellobyte', 'Update'), ['update', 'degree' => $model->degree, 'year' => $model->year, 'certificated_by' => $model->certificated_by], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('hellobyte', 'Delete'), ['delete', 'degree' => $model->degree, 'year' => $model->year, 'certificated_by' => $model->certificated_by], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('hellobyte', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'e_id',
            'degree',
            'year',
            'certificated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
