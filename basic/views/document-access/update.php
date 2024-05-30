<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentAccess */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Document Access',
]) . $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['folder/index']];
$this->params['breadcrumbs'][] = ['label' => $document->idFolder->title, 'url' => ['folder/view', 'id' => $document->idFolder->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['document/index', 'id_folder' => $document->idFolder->id]];
$this->params['breadcrumbs'][] = ['label' => $document->title, 'url' => ['document/view', 'id' => $document->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Document Accesses'), 'url' => ['index', 'id_document' => $document->id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="document-access-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
