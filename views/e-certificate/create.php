<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model hellobyte\employee\models\ECertificate */

$this->title = Yii::t('hellobyte', 'Create Ecertificate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('hellobyte', 'Ecertificates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ecertificate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
