<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documents');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['folder/index']];
$this->params['breadcrumbs'][] = ['label' => $folder->title, 'url' => ['folder/view', 'id' => $folder->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Document'), ['create', 'id_folder' => $folder->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
				'class' => 'yii\grid\SerialColumn',
				'options' => ['width' => '70'],
			],    

            //'id',            
            'registration_date',
            'number',
            'title',
            // 'description:ntext',
            'page_count',
            // 'destination',
            // 'id_user',
			
			//'links:html',
            
			[
				'attribute' => 'id_document_status',				
				'filter' => ArrayHelper::map(app\models\DocumentStatus::find()->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idDocumentStatus;					
					if (empty($var) == false)
					{						
						return $var->title;
					}										
					return '';
				},
			
			],   			

            [
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{view} {update} {delete} {files}',
				'buttons' =>
					[
						'files'=>  function ($url, $model, $key)
						{							
							return Html::a('<span class="glyphicon glyphicon-file"></span>', ['file/index', 'id_document' => $model->id], ['title' => Yii::t('app', 'Files')]);
						}
					],	
				'options' => ['width' => '87'],
			],				
        ],
    ]); ?>
</div>
