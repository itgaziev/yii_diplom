<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Folder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folder-form">

    <?php $form = ActiveForm::begin(); ?>
    
	<?= $form->field($model, 'id_partition')->dropDownList(ArrayHelper::map(app\models\Partition::find()->orderby(['title'=>'title asc'])->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>   
	
	<?php 
		//echo $form->field($model, 'id_user')->dropDownList(ArrayHelper::map(app\models\User::find()->orderby(['last_name'=>SORT_ASC, 'first_name'=>SORT_ASC])->all(), 'id', 'title')); 
	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
