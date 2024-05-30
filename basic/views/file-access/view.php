<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FileAccess */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['folder/index']];
$this->params['breadcrumbs'][] = ['label' => $file->idDocument->idFolder->title, 'url' => ['folder/view', 'id' => $file->idDocument->idFolder->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['document/index', 'id_folder' => $file->idDocument->idFolder->id]];
$this->params['breadcrumbs'][] = ['label' => $file->idDocument->title, 'url' => ['document/view', 'id' => $file->idDocument->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Files'), 'url' => ['file/index', 'id_document' => $file->idDocument->id]];
$this->params['breadcrumbs'][] = ['label' => $file->title, 'url' => ['file/view', 'id' => $file->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'File Accesses'), 'url' => ['index', 'id_file' => $file->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-access-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create File Access'), ['create', 'id_file' => $file->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',                        
            [
				'attribute' => 'id_file',						
				'value' => empty ($model->idFile) == false ? $model->idFile->title : '',
			],  
			[
				'attribute' => 'id_user',						
				'value' => empty ($model->idUser) == false ? $model->idUser->title : '',
			],  
            [
				'attribute' => 'id_department',						
				'value' => empty ($model->idDepartment) == false ? $model->idDepartment->title : '',
			],   
            [
				'attribute' => 'id_user_type',						
				'value' => empty ($model->idUserType) == false ? $model->idUserType->title : '',
			],   
            'flag_view:boolean',
            'flag_edit:boolean',
            'flag_delete:boolean',
        ],
    ]) ?>

</div>
