<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\DetailView;

$this->title = Yii::$app->params['projectName'];



				function GetStatusTitle ($data)
				{
					$var = $data->status;					
					if ($var == app\models\User::STATUS_ACTIVE)
					{						
						return Yii::t('app', 'Active User');
					}					
					if ($var == app\models\User::STATUS_DELETED)
					{						
						return Yii::t('app', 'Deleted User');
					}		
					if ($var == app\models\User::STATUS_REGISTRED)
					{						
						return Yii::t('app', 'Registred User');
					}						
					return '';
				}


?>



<div class="site-index">


	<h1><?= Html::encode(Yii::t('app', 'User Data')) ?></h1>
	
	

	<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',            
			'last_name',   
			'first_name',   
			'middle_name',
			'birthday:date',
			'phone',   
            'email:email',  
			'username',  
			[
				'attribute' => 'id_department',						
				'value' => empty ($model->idDepartment) == false ? $model->idDepartment->title : '',
			],   
			[
				'attribute' => 'id_user_function',						
				'value' => empty ($model->idUserFunction) == false ? $model->idUserFunction->title : '',
			],   
			[
				'attribute' => 'id_user_type',						
				'value' => empty ($model->idUserType) == false ? $model->idUserType->title : '',
			],   
			[
				'attribute' => 'status',						
				'value' => GetStatusTitle ($model),
			],   
            'created_at:date',
            'updated_at:date',		
           
        ],
    ]) ?>
	
	<p>		
        <?= Html::a(Yii::t('app', 'Update'), ['user/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
	
	
	
</div>
