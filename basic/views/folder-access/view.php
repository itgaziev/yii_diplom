<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FolderAccess */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['folder/index']];
$this->params['breadcrumbs'][] = ['label' => $folder->title, 'url' => ['folder/view', 'id' => $folder->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folder Accesses'), 'url' => ['index', 'id_folder' => $folder->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-access-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create Folder Access'), ['create', 'id_folder' => $folder->id], ['class' => 'btn btn-success']) ?>
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
            [
				'attribute' => 'id_folder',						
				'value' => empty ($model->idFolder) == false ? $model->idFolder->title : '',
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
