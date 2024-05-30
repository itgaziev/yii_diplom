<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\FileAccess */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-access-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'id_user')->dropDownList(ArrayHelper::map(app\models\User::find()->where('id_user_type <> 1')->orderby(['last_name'=>SORT_ASC, 'first_name'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')])  ?> 

    <?= $form->field($model, 'id_department')->dropDownList(ArrayHelper::map(app\models\Department::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>
    
	<?= $form->field($model, 'id_user_type')->dropDownList(ArrayHelper::map(app\models\UserType::find()->where('id <> 1')->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>

    <?= $form->field($model, 'flag_view')->checkbox() ?>

    <?= $form->field($model, 'flag_edit')->checkbox() ?>

    <?= $form->field($model, 'flag_delete')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
