<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\File */

$this->title = $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['folder/index']];
$this->params['breadcrumbs'][] = ['label' => $folder->title, 'url' => ['folder/view', 'id' => $folder->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['document/index', 'id_folder' => $folder->id]];
$this->params['breadcrumbs'][] = ['label' => $document->title, 'url' => ['document/view', 'id' => $document->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Files'), 'url' => ['index', 'id_document' => $document->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create File'), ['create', 'id_document'=>$document->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a(Yii::t('app', 'Access'), ['file-access/index', 'id_file'=>$model->id], ['class' => 'btn btn-success']) ?>
		<?php 
			if (empty ($model->filename) == false)
				echo Html::a(Yii::t('app', 'Load File'), ['download', 'id'=>$model->id], ['class' => 'btn btn-success']);
		?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
			[
				'attribute' => 'id_document',	
				'value' => empty ($model->idDocument) == false ? $model->idDocument->title : '',
			],   
            'registration_date',
            'number',
            'title',
            'filename',
            'size',            
			[
				'attribute' => 'id_user',
				'value' => empty ($model->idUser) == false ? $model->idUser->title : '',
			],   
        ],
    ]) ?>

</div>
