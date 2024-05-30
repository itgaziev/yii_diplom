<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Document */

$this->title = $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['folder/index']];
$this->params['breadcrumbs'][] = ['label' => $folder->title, 'url' => ['folder/view', 'id' => $folder->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index', 'id_folder' => $folder->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create Document'), ['create', 'id_folder' => $folder->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>		
		<?= Html::a(Yii::t('app', 'Access'), ['document-access/index', 'id_document'=>$model->id], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'Files'), ['file/index', 'id_document' => $model->id], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'Report Document'), ['report/document', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            
			[
				'attribute' => 'id_folder',		
				'value' => empty ($model->idFolder) == false ? $model->idFolder->title : '',
			],   
            'registration_date',
            'number',
            'title',
            'description:ntext',
            'page_count',
            'destination',
            [
				'attribute' => 'id_user',		
				'value' => empty ($model->idUser) == false ? $model->idUser->title : '',
			],   
            
			[
				'attribute' => 'id_document_status',		
				'value' => empty ($model->idDocumentStatus) == false ? $model->idDocumentStatus->title : '',
			],   
			
			[
				'attribute' => 'id_document_kind',		
				'value' => empty ($model->idDocumentKind) == false ? $model->idDocumentKind->title : '',
			],   
        ],
    ]) ?>

</div>
