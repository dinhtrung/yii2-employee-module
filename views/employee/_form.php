<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\TabularForm;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $model hellobyte\employee\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true])
    ->hint(Yii::t('hellobyte', 'Employee ID (Alphanumeric)')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])
    ->hint(Yii::t('hellobyte', 'Employee Name (25 characters)')) ?>

    <?= $form->field($model, 'dob')->textInput()
    ->hint(Yii::t('hellobyte', 'Date of Birth (dd/mm/yyyy)')) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6])
    ->hint(Yii::t('hellobyte', 'Permanent Address')) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])
    ->hint(Yii::t('hellobyte', 'Email Address')) ?>

    <?= $form->field($model, 'photo')->fileInput()
    ->hint(Yii::t('hellobyte', 'Photo (passport size')) ?>

    <?= $form->field($model, 'sex')->dropDownList([
    		NULL => '--- Select Gender ---',
    		0 => 'Female',
    		1 => 'Male',
    ]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= TabularForm::widget([
    		'form' => $form,
    		'dataProvider' => $certificateModels,
    		'attributes' => [
    				'degree' => ['type' => TabularForm::INPUT_TEXT],
    				'year' => ['type' => TabularForm::INPUT_TEXT],
    				'certificated_by' => ['type' => TabularForm::INPUT_TEXT],
			],
    		'gridSettings' => [
    				'floatHeader' => true,
    				'panel' => [
    						'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Manage Books</h3>',
    						'type' => GridView::TYPE_PRIMARY,
    						'after'=>
    						Html::a(
    								'<i class="glyphicon glyphicon-plus"></i> Add New',
    								['e-certificate/create'],
    								['class'=>'btn btn-success']
    						) . '&nbsp;' .
    						Html::a(
    								'<i class="glyphicon glyphicon-remove"></i> Delete',
    								['e-certificate/delete'],
    								['class'=>'btn btn-danger']
    						)
    				]
    		]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('hellobyte', 'Create') : Yii::t('hellobyte', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
