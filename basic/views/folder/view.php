<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Folder */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create Folder'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a(Yii::t('app', 'Access'), ['folder-access/index', 'id_folder'=>$model->id], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'Documents'), ['document/index', 'id_folder' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',            
			[
				'attribute' => 'id_partition',			
				'value' => empty ($model->idPartition) == false ? $model->idPartition->title : '',
			],   
            'registration_date',
            'number',
            'title',            
			[
				'attribute' => 'id_user',			
				'value' => empty ($model->idUser) == false ? $model->idUser->title : '',
			],   
        ],
    ]) ?>

</div>
