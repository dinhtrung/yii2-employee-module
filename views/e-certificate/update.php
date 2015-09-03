<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model hellobyte\employee\models\ECertificate */

$this->title = Yii::t('hellobyte', 'Update {modelClass}: ', [
    'modelClass' => 'Ecertificate',
]) . ' ' . $model->degree;
$this->params['breadcrumbs'][] = ['label' => Yii::t('hellobyte', 'Ecertificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->degree, 'url' => ['view', 'degree' => $model->degree, 'year' => $model->year, 'certificated_by' => $model->certificated_by]];
$this->params['breadcrumbs'][] = Yii::t('hellobyte', 'Update');
?>
<div class="ecertificate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
