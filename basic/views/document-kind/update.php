<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentKind */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Document Kind',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Document Kinds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="document-kind-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
