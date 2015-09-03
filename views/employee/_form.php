<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model hellobyte\employee\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => false, 'options' => ['enctype' => 'multipart/form-data']]); ?>

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

    <?= $form->field($model, 'photoFile')->fileInput()
    ->hint(Yii::t('hellobyte', 'Photo (passport size')) ?>

    <?= $form->field($model, 'sex')->dropDownList([
    		NULL => '--- Select Gender ---',
    		0 => 'Female',
    		1 => 'Male',
    ]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?php // Pjax::begin() ?>

    	<div class="cert-first">
    		<div class="row">
    			<div class="col-xs-1 cnt">#</div>
    			<div class="col-xs-3">
			    	<strong><?= $cert->getAttributeLabel('degree'); ?></strong>
    			</div>
    			<div class="col-xs-1">
			    	<strong><?= $cert->getAttributeLabel('year'); ?></strong>
    			</div>
    			<div class="col-xs-7">
			    	<strong><?= $cert->getAttributeLabel('certificated_by'); ?></strong>
    			</div>
    		</div>
    	</div>
    	<div class="cert-form">
    			<?php $i = count($certs = $model->getECertificates()->all()); ?>
    			<?php foreach ($certs as $k => $ecert): ?>
				<div class="row">
	    			<div class="col-xs-1"><?= $k + 1?></div>
	    			<div class="col-xs-3">
				    	<?= $form->field($ecert, "[$k]degree")->label(false) ?>
	    			</div>
	    			<div class="col-xs-1">
					<?= $form->field($ecert, "[$k]year")->label(false) ?>
	    			</div>
	    			<div class="col-xs-7">
					<?= $form->field($ecert, "[$k]certificated_by")->label(false) ?>
	    			</div>
	    		</div>

    			<?php endforeach; ?>
    	</div>
    	<div class="cert-last">
    		<div class="row">
    			<div class="col-xs-1 cnt"><?= $i+1?></div>
    			<div class="col-xs-3">
			    	<?= $form->field($cert, "[$i]degree")->label(false) ?>
    			</div>
    			<div class="col-xs-1">
				<?= $form->field($cert, "[$i]year")->label(false) ?>
    			</div>
    			<div class="col-xs-7">
				<?= $form->field($cert, "[$i]certificated_by")->label(false) ?>
    			</div>
    		</div>
    	</div>
    	<?= Html::a('Add Certificates', null, ['class' => 'btn btn-primary pull-right', 'id' => 'add-cert'])?>


    <?php // Pjax::end() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('hellobyte', 'Create') : Yii::t('hellobyte', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js =<<< HEREDOC
(function ($) {
		$("#add-cert").click(function(){
				content = $(".cert-last").html();
				$(".cert-form").append(content);
				count = parseInt($(".cert-last .cnt").html());
				console.log(count);
				$(".cert-last .cnt").html(count + 1);
				ctn = $(".cert-last").html();
				console.log (ctn);
				re = new RegExp('[' + (count - 1) + ']', 'g');
				ctn = ctn.replace(re, '[' + count + ']');
				console.log(ctn);
				$(".cert-last").html(ctn);
		});
}(jQuery));
HEREDOC;
$this->registerJs($js);?>
