<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FileAccessSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-access-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_file') ?>

    <?= $form->field($model, 'id_rule_type') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'id_department') ?>

    <?php // echo $form->field($model, 'id_user_type') ?>

    <?php // echo $form->field($model, 'flag_view')->checkbox() ?>

    <?php // echo $form->field($model, 'flag_edit')->checkbox() ?>

    <?php // echo $form->field($model, 'flag_delete')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
