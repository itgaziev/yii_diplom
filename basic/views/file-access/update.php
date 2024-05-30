<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FileAccess */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'File Access',
]) . $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['folder/index']];
$this->params['breadcrumbs'][] = ['label' => $file->idDocument->idFolder->title, 'url' => ['folder/view', 'id' => $file->idDocument->idFolder->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['document/index', 'id_folder' => $file->idDocument->idFolder->id]];
$this->params['breadcrumbs'][] = ['label' => $file->idDocument->title, 'url' => ['document/view', 'id' => $file->idDocument->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Files'), 'url' => ['file/index', 'id_document' => $file->idDocument->id]];
$this->params['breadcrumbs'][] = ['label' => $file->title, 'url' => ['file/view', 'id' => $file->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'File Accesses'), 'url' => ['index', 'id_file' => $file->id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="file-access-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
