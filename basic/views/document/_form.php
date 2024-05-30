<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'id_folder')->dropDownList(ArrayHelper::map(app\models\Folder::find()->orderby(['title'=>'title asc'])->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'page_count')->textInput() ?>

    <?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?>    
	
	<?= $form->field($model, 'id_document_status')->dropDownList(ArrayHelper::map(app\models\DocumentStatus::find()->orderby(['title'=>'title asc'])->all(), 'id', 'title')) ?>
	
	<?= $form->field($model, 'id_document_kind')->dropDownList(ArrayHelper::map(app\models\DocumentKind::find()->orderby(['title'=>'title asc'])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
