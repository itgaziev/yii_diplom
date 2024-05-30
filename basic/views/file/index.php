<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Files');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['folder/index']];
$this->params['breadcrumbs'][] = ['label' => $folder->title, 'url' => ['folder/view', 'id' => $folder->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['document/index', 'id_folder' => $folder->id]];
$this->params['breadcrumbs'][] = ['label' => $document->title, 'url' => ['document/view', 'id' => $document->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create File'), ['create', 'id_document'=>$document->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [            
            [
				'class' => 'yii\grid\SerialColumn',
				'options' => ['width' => '70'],
			],    
            //'id_document',
            'registration_date',
            'number',
            'title',
            'filename',
            'size',
            // 'id_user',          
			
			[
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{view} {update} {delete} {download}',
				'buttons' =>
					[
						'download'=>  function ($url, $model, $key)
						{	
							if (empty($model->filename) == true)
								return '';
							return Html::a('<span class="glyphicon glyphicon-download"></span>', ['download', 'id' => $model->id], ['title' => Yii::t('app', 'Download')]);
						}
					],	
				'options' => ['width' => '87'],
			],			
        ],
    ]); ?>
</div>
