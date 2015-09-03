<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model hellobyte\employee\models\Employee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('hellobyte', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('hellobyte', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('hellobyte', 'Delete'), ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            'dob',
            'address:ntext',
            'email:email',
            [ 'label' => 'Photo', 'value' => Html::img('@web/uploads/' . $model->photo), 'format' => 'html' ],
            [ 'label' => 'Sex', 'value' => ($model->sex === 0)?'Female':($model->sex?'Male':'Unknown'), 'format' => 'html' ],
            'telephone',
            'nationality',
            'created_at:datetime',
            'created_by',
            'updated_at:datetime',
            'updated_by',
        ],
    ]) ?>

    <?= GridView::widget([
    		'dataProvider' => $certs,
    		'columns' => [
    				'degree',
    				'year',
    				'certificated_by',
    ]

    ])?>

</div>
