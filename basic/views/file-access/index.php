<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileAccessSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'File Accesses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folders'), 'url' => ['folder/index']];
$this->params['breadcrumbs'][] = ['label' => $file->idDocument->idFolder->title, 'url' => ['folder/view', 'id' => $file->idDocument->idFolder->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['document/index', 'id_folder' => $file->idDocument->idFolder->id]];
$this->params['breadcrumbs'][] = ['label' => $file->idDocument->title, 'url' => ['document/view', 'id' => $file->idDocument->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Files'), 'url' => ['file/index', 'id_document' => $file->idDocument->id]];
$this->params['breadcrumbs'][] = ['label' => $file->title, 'url' => ['file/view', 'id' => $file->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-access-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create File Access'), ['create', 'id_file' => $file->id], ['class' => 'btn btn-success']) ?>
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
				'attribute' => 'id_user',			
				'filter' => ArrayHelper::map(app\models\User::find()->where('id_user_type <> 1')->orderby(['last_name'=>SORT_ASC, 'first_name'=>SORT_ASC,])->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idUser;					
					if (empty($var) == false)
					{						
						return $var->title;
					}										
					return '';
				},
			
			],   			
			
			[
				'attribute' =>  'id_department',			
				'filter' => ArrayHelper::map(app\models\Department::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idDepartment;					
					if (empty($var) == false)
					{						
						return $var->title;
					}										
					return '';
				},
			
			],   		

			[
				'attribute' =>  'id_user_type',			
				'filter' => ArrayHelper::map(app\models\UserType::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idUserType;					
					if (empty($var) == false)
					{						
						return $var->title;
					}										
					return '';
				},
			
			],  			
            
            'flag_view:boolean',
            'flag_edit:boolean',
            'flag_delete:boolean',
			
            [
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{view} {update} {delete}',				
				'options' => ['width' => '70'],
			],			
        ],
    ]); ?>
</div>
