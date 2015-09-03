<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model hellobyte\employee\models\Employee */

$this->title = Yii::t('hellobyte', 'Create Employee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('hellobyte', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        	'model' => $model,
    		'certificateModels' => $certificateModels,
    ]) ?>

</div>
