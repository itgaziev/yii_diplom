<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\File */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-form">

    <?php $form = ActiveForm::begin([
				'method' => 'post',
				//'action' => ['controller/action'],
				'enableClientValidation' => false, 
				'options' => ['enctype' => 'multipart/form-data'],
			]); 
	?>	
	
	<?= $form->field($model, 'id_document')->dropDownList(ArrayHelper::map(app\models\Document::find()->orderby(['title'=>'title asc'])->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	
	<?= FileInput::widget([
			'model' => $model,
			'attribute' => 'ffile',
			'options' => ['multiple' => !true /*, 'accept' => 'image/*'*/], 
			'pluginOptions' => [
				'showPreview' => !true,
				'showCaption' => true,
				'showRemove' => true,
				'showUpload' => !true,
				//'allowedFileExtensions' => ['*.*'],
				//'uploadUrl' => Yii::$app->urlManager->createUrl (['/loader/image-loader-method']),
				],		
		]) 
	?>	
	
	<br>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
