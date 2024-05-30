<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\File */
$this->title = Yii::t('app', 'Create File');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['folder/index']];
$this->params['breadcrumbs'][] = ['label' => $folder->title, 'url' => ['folder/view', 'id' => $folder->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['document/index', 'id_folder' => $folder->id]];
$this->params['breadcrumbs'][] = ['label' => $document->title, 'url' => ['document/view', 'id' => $document->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Files'), 'url' => ['index', 'id_document' => $document->id]];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
