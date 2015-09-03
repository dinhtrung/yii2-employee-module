<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model hellobyte\employee\models\Employee */

$this->title = Yii::t('hellobyte', 'Update {modelClass}: ', [
    'modelClass' => 'Employee',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('hellobyte', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('hellobyte', 'Update');
?>
<div class="employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        	'model' => $model,
    		'certificateModels' => $certificateModels,
    ]) ?>

</div>
