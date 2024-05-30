<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FolderAccessSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folder-access-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_folder') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'id_department') ?>

    <?= $form->field($model, 'id_user_type') ?>

    <?php // echo $form->field($model, 'flag_view')->checkbox() ?>

    <?php // echo $form->field($model, 'flag_edit')->checkbox() ?>

    <?php // echo $form->field($model, 'flag_delete')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
