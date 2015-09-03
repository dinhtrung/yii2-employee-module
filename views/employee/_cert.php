<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$form = new ActiveForm();
?>
<?= Html::a(Yii::t('hellobyte', 'Add new certificate'), '', ['class' => 'btn btn-default btn-primary']) ?>


<?= $form->field($cert, 'degree')->textInput(['maxlength' => true]) ?>
<?= $form->field($cert, 'year')->textInput(['maxlength' => true]) ?>
<?= $form->field($cert, 'certificated_by')->textInput(['maxlength' => true]) ?>
<hr/>
<?= $form->field($cert, 'degree')->textInput(['maxlength' => true]) ?>
<?= $form->field($cert, 'year')->textInput(['maxlength' => true]) ?>
<?= $form->field($cert, 'certificated_by')->textInput(['maxlength' => true]) ?>

