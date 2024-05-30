<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FolderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Folders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Folder'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            
			[
				'class' => 'yii\grid\SerialColumn',
				'options' => ['width' => '70'],
			],           
            [
				'attribute' => 'id_partition',				
				'filter' => ArrayHelper::map(app\models\Partition::find()->orderby(['title'=>'title asc'])->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idPartition;					
					if (empty($var) == false)
					{						
						return $var->title;
					}										
					return '';
				},
			
			],   			
            'registration_date',
            'number',
            'title',
            // 'id_user',
			
			
			
			[
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{view} {update} {delete} {documents}',
				'buttons' =>
					[
						'documents'=>  function ($url, $model, $key)
						{							
							return Html::a('<span class="glyphicon glyphicon-tasks"></span>', ['document/index', 'id_folder' => $model->id], ['title' => Yii::t('app', 'Documents')]);
						}
					],	
				'options' => ['width' => '87'],
			],			
        ],
    ]); ?>
</div>
