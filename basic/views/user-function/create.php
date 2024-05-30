<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserFunction */

$this->title = Yii::t('app', 'Create User Function');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Functions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-function-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
