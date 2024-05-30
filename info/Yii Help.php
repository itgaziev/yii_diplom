
************************************************************************************************************************
����������� ����������
************************************************************************************************************************

C:\WEB\Sites\htdocs\basic

"C:\WEB\PHP\PHP 5.4.39\php.exe" composer.phar require kartik-v/yii2-widgets "*"

php composer.phar require 2amigos/yii2-gallery-widget:~1.0
php composer.phar require "2amigos/yii2-google-maps-library" "*"
php composer.phar require --prefer-dist miloschuman/yii2-highcharts-widget "*"
php composer.phar require kartik-v/yii2-grid "@dev"
php composer.phar require kartik-v/yii2-widgets "*"
php composer.phar require kartik-v/yii2-tabs-x "@dev"



************************************************************************************************************************
���������� ����� (��������� ������ � ������)
************************************************************************************************************************

<?php
	// http://nix-tips.ru/yii2-razbiraemsya-s-gridview.html
?>	

	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions' => function($model, $key, $index)
                    {						
                        return ['style' => ['background'=>'green']];
                    },					
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'id',			
				'contentOptions' => function($model)
                    {						
                        return ['style' => ['background'=>'black']];
                    }
			],
		]
	])
?>


************************************************************************************************************************
����� ���������������� ����������
************************************************************************************************************************
<?
	use yii\base\UserException;	
?>
************************************************************************************************************************
�������� ��������� � Yii2
************************************************************************************************************************
<?php
	//
	// http://www.yiiframework.com/extension/yii2-highcharts-widget
	// php composer.phar require --prefer-dist miloschuman/yii2-highcharts-widget "*"
	//
	
	use miloschuman\highcharts\Highcharts;

	
	
				$data = $dataProvider->allModels;
				
				$categories = [];
				$created = [];
				$closed = [];
				$processing = [];
				
				for ($i = 0; $i < count ($data); $i ++)
				{
					$categories[] = \Yii::$app->formatter->asDate($data[$i]['date']);
					$created[] = $data[$i]['created'] + 0;
					$closed[] = $data[$i]['closed'] + 0;
					$processing[] = $data[$i]['processing'] + 0;					
				}
				
				echo Highcharts::widget([
					'options' => [
						'title' => ['text' => Yii::t('app', 'Common Report')],
						'xAxis' => [
							'categories' => $categories
						],
						'yAxis' => [
							'title' => ['text' => '���������� ������']
						],
						'series' => [
							['name' => '�������', 'data' => $created],
							['name' => '�������', 'data' => $closed],
							['name' => '� ������', 'data' => $processing],
						], 
					]
				]);
			?>
			


************************************************************************************************************************
������ ��� GridView (�� ������� � �� ����)
************************************************************************************************************************
<?php
		$data = [];		
		for ($i = 0; true; $i ++)
		{			
			$record = [];
			$date = strtotime($date1 . ' +' . $i . ' day');						
			if ($date > strtotime($date2))
				break;			
			$record['date'] = $date;
			$record['created'] = $this->RequestCount�reated($date);
			$record['closed'] = $this->RequestCountClosed($date);
			$record['processing'] = $this->RequestCountProcessing($date);
			$data[] = $record;			
		}				

		$dataProvider = new ArrayDataProvider([
			'allModels' => $data,
			'sort' => [
				'attributes' => ['date', 'created', 'closed', 'processing'],
			],
			'pagination' => [
				'pageSize' => 20,
			],
		]);		
		
        return $this->render('common', [
            'dataProvider' => $dataProvider,
			'Settings' => $Settings,
        ]);				
?>

<?php
		$dataProvider = new ActiveDataProvider([
            'query' => $Q
			,
        ]);
		
		return $this->render('common', [
            'dataProvider' => $dataProvider,
			'Settings' => $Settings,
        ]);	
?>

************************************************************************************************************************
�������������� � Yii2
************************************************************************************************************************

<?php

	\Yii::$app->formatter->format($model->description, 'ntext');
	
	\Yii::$app->formatter->asDate($dateStr, $fmt);
	

?>

************************************************************************************************************************
������ ��� ���� ��������������
************************************************************************************************************************
<?php 
use yii\helpers\ArrayHelper;
<?= $form->field($model, '')->dropDownList(ArrayHelper::map(app\models\TranspotType::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title')) ?>
<?= $form->field($model, '')->dropDownList(ArrayHelper::map(app\models\TranspotType::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]) ?>
?>
************************************************************************************************************************
����� ��� ���������� ����������� ��� ������� �� ������
************************************************************************************************************************
<?php 
	if (empty($_GET['filter']) == false)
		echo $this->render('_search', ['model' => $searchModel]); 
?>
<?php 
	if (empty($_GET['filter']) == false)
	{
		echo Html::a(Yii::t('app', 'Hide filter'), ['index', 'filter'=>'0'], ['class' => 'btn btn-default']); 
	}
	else
	{
		echo Html::a(Yii::t('app', 'Show filter'), ['index', 'filter'=>'1'], ['class' => 'btn btn-success']);
	}			
?>	
<input type="hidden" name="filter" value="1">
************************************************************************************************************************
������ � �������
************************************************************************************************************************
<?php 
		 public function actionIndex()
    {
		Yii::$app->user->identity->accessAdminOnly;		
		
        $searchModel = new SysUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

?>

<?php 
	echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
			//'status',
			'user_type',
			'username',
            'user_status',            
			'email:email',   
			'last_name',
			'first_name',
			'middle_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
?>
************************************************************************************************************************
���������� ��������������� �������� � ������ (��������� �����, ������)
************************************************************************************************************************
<?php 
	public function getSum()
	{
		//
                
		$Data = $this->idService;
		if (isset ($Data))
		{
			return $Data->cost * $this->amount;			
		}
	
	}
?>	
************************************************************************************************************************
���������� � ������ ����������� �������� �����������
************************************************************************************************************************
<?php 	
	public $image;	
	public function getOriginal_image_url ()
	{
		//
		if ((empty ($this->id) == false))
		{
			//			
			return Yii::$app->params['imageDir'] . 'Request/original/' . $this->id;
		}
	}	
	public function getImage_url ()
	{
		//
		if ((empty ($this->id) == false))
		{
			//
			//return $this->getThumbFileUrl('image', 'thumb');						
			return Yii::$app->params['imageDir'] . 'Request/thumb/' . $this->id;
		}
	}	
	public function behaviors()
	{
		return 
		[
			[
             'class' => '\yiidreamteam\upload\ImageUploadBehavior',
             'attribute' => 'image',			
             'thumbs' => ['thumb' => ['width' => 100, 'height' => 100], ],			 
             'filePath' => Yii::$app->params['imagePath'] . '[[model]]/original/[[pk]]',
             'fileUrl' => Yii::$app->params['imageDir'] . '[[model]]/original/[[pk]]',			 
             'thumbPath' => Yii::$app->params['imagePath'] . '[[model]]/thumb/[[pk]]',
             'thumbUrl' => Yii::$app->params['imageDir'] . '[[model]]/thumb/[[pk]]',			 
			]		
		];
	}
?>	
	
<?php
	use kartik\widgets\FileInput;
?> 

	<?php $form = ActiveForm::begin(['enableClientValidation' => false, 'options' => ['enctype' => 'multipart/form-data']]); ?>
	
	<?= $form->field($model, 'image')->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*'],
    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
]]); ?> 
	<?php 
		if (empty ($model->original_image_url) == false)
			echo Html::img ($model->original_image_url, ['width'=>'100%']); 
		
	?>	
    <?= '<br><br>' ?>     

<?php
	public function attributeLabels()
    {
        return [
			'original_image_url:image',	
			'image' => Yii::t('app', '����'),
			'original_image_url' => Yii::t('app', '����'),
			'image_url' => Yii::t('app', '����'),
		];
	}
?> 

************************************************************************************************************************
�������� ������ (�� ���� ��������)
************************************************************************************************************************
<?php			
	Yii::$app->urlManager->createUrl (['movie/evaluate']);
?> 
************************************************************************************************************************
��������� ������������ �� ��������
************************************************************************************************************************
<?php

		$Referrer = Yii::$app->getRequest()->getReferrer();	
		if (isset ($Referrer))
		{
			$this->redirect($Referrer);
		}
		else
		{
			//
			$this->goHome();
		}
?> 
************************************************************************************************************************
������������������ ���� � NetBeanse
************************************************************************************************************************
<?php
	'NetBeanse ������������������ ���� Alt + Shift + f'
?> 
************************************************************************************************************************
��������� ������� � ������� ������������ 
************************************************************************************************************************
<?php
	use yii\filters\AccessControl;	
	public function behaviors()
    {	
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
			
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
					'actions' => ['index', 'view', 'create', 'update', 'delete'],
					'allow' => true,
					'roles' => ['@'],
					],
				],
			],				
			
        ];
    }
	
?> 
************************************************************************************************************************
���������� �������� ������� � ������� �����������
************************************************************************************************************************
<?

	use yii\filters\AccessControl;	

	public function behaviors()
    {	
        return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => 
				[	
					[
						'actions' => ['index', 'view', 'create', 'update', 'delete'],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsAdmin || Yii::$app->user->identity->IsExpert;
						}
					],					
				],
			],			
		
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
?> 

************************************************************************************************************************
���������� ����� � DetailView
************************************************************************************************************************


	<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'loading_date',
			
            [
				'attribute' => 'id_content_type',	
				'value' => empty ($model->idContentType) == false ? $model->idContentType->title : '',
			],   
			
            [
				'attribute' => 'id_content_state',								
				'value' => empty ($model->idContentState) == false ? $model->idContentState->title : '',
			],   
		
            'title',
            'description:ntext',
            'html_code:ntext',
            'public_code',
			
            [				
				'attribute' => 'id_user',						
				'value' => empty ($model->idUser) == false ? $model->idUser->username : '',
			],                        
			[
				'attribute' => 'id_image',		
				'format' => 'raw',
				'value' => empty ($model->ImageFullName) == false ? Html::img ($model->ImageFullName) : '',
			],   
        ],
    ]) ?>

************************************************************************************************************************
���������� ����� � GridView
************************************************************************************************************************
	
use yii\helpers\ArrayHelper;

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
				'attribute' => 'id',
				'options' => ['width' => '100'],
			],  
			[
				'attribute' => 'loading_date',
				//'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
				'options' => ['width' => '200'],
			],
			[
				'attribute' => 'id_content_type',				
				'filter' => ArrayHelper::map(app\models\ContentType::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idContentType;
					if (empty($var) == false)
						return $var->title;
					return '';
				},
			
			],   
			[
				'attribute' => 'id_content_state',				
				'filter' => ArrayHelper::map(app\models\ContentState::find()->orderby(['title'=>SORT_ASC])->all(), 'id', 'title'),
				'content' => function($data)
				{
					$var = $data->idContentState;
					if (empty($var) == false)
						return $var->title;
					return '';
				},
			],                 
            'title',
            [
				'attribute' => 'id_user',				
				'filter' => ArrayHelper::map(app\models\User::find()->orderby(['username'=>'username asc'])->all(), 'id', 'username'),
				'content' => function($data)
				{
					$var = $data->idUser;
					if (empty($var) == false)
						return $var->username;
					return '';
				},
			],                 
			
			[
				'label' => Yii::t('app', 'Image'),
				'format' => 'raw',
				'value' => function($data)
				{
					return Html::img($data->ImageFullName, ['style' => 'width:150px;']);
				},
			],

            [
				'class' => 'yii\grid\ActionColumn', 
				'template' => '{documents} {view} {update} {delete}',
				'buttons' =>
					[
						'documents'=>  function ($url, $model, $key)
						{							
							return Html::a('<span class="glyphicon glyphicon-tasks"></span>', ['document/index', 'id_folder' => $model->id], ['title' => Yii::t('app', 'Documents'), 'target'=>'_blank']);
						}
					],	
				'options' => ['width' => '85'],
			 
			
			],
			
        ],
    ]); ?>
	

************************************************************************************************************************
�������� ���� ����������� ������ � Grid
************************************************************************************************************************
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'model',

            ['class' => 'yii\grid\ActionColumn', 
			 'template' => '{view} {update} {delete} {kitset}',
			 'buttons'=>
				[
				'kitset'=>  function ($url, $model, $key)
					{
						$url=Yii::$app->getUrlManager()->createUrl(['kit-element/index','id_kit'=>$model['id']]);
						return Html::a(/*'<span class="glyphicon glyphicon glyphicon-pencil"></span>'*/ '������', $url, ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0',]);
					}
				],							
			
			],
        ],
    ]); 
?>
************************************************************************************************************************
��������� ������ ������ ��������������
************************************************************************************************************************
<?php
		if (Yii::$app->user->identity->isAdmin == false)
		{
			throw new \Exception (Yii::t('app', 'For admin only'));
		}
		$Results = Yii::$app->db->createCommand($Query->body, [':param_id_sys_user' => $id_user])->queryAll();       			
?>



************************************************************************************************************************
��������� � ���� ������ ����� ������� ���������� (����������� ����� ������)
************************************************************************************************************************
<?php
	$Results = Yii::$app->db->createCommand($Query->body, [':param_id_sys_user' => $id_user])->queryAll();       			
?>
************************************************************************************************************************
������������� TabX
************************************************************************************************************************
<?php
	use kartik\tabs\TabsX;
	$tabs[] = [
		'label' => $mark->title,
		'content' => TabsX::widget([
			'position' => TabsX::POS_ABOVE,
			'align' => TabsX::ALIGN_LEFT,			
			'items' => $sub_tabs,
			'bordered' => true,
		]),						
	];
	echo TabsX::widget([
				'position' => TabsX::POS_ABOVE,
				'align' => TabsX::ALIGN_LEFT,			
				'items' => $tabs,
				'bordered' => true,
				]);						
?>
************************************************************************************************************************
�������� ������ � ���������
************************************************************************************************************************
<?php				
	public function actionRequestJournal()
    {	
		Yii::$app->user->identity->AccessAdminManager;
		
		
		$User = User::find()->where (['id'=> Yii::$app->user->identity->id])->one();				
		
        $dataProvider = new ActiveDataProvider([
            'query' => Request::find()->where ('date_reg >= :date1 and date_reg < :date2', [':date1'=>$User->report_date_1, ':date2'=>$User->report_date_2])
			->andFilterWhere(['id_user'=>$User->report_id_user, 'id_defect'=>$User->report_id_defect, 'id_client'=>$User->report_id_client])
			,
        ]);
        return $this->render('report-request-journal', [
            'dataProvider' => $dataProvider,
			'ReportParams' => User::findOne(Yii::$app->user->identity->id),
        ]);
    }  
?>
************************************************************************************************************************
����������� ������� � Yii
************************************************************************************************************************
<?php

	use yii\data\ActiveDataProvider;

	public function actionServicesStat()
    {	
	
		Yii::$app->user->identity->AccessAdminManager;
		
		$User = User::find()->where (['id'=> Yii::$app->user->identity->id])->one();				
		
		$Q = new Yii\db\Query ();
		
		$Q->select([
				'service.id',
				'service.title',
				'service.cost',	
				'sum(request_service.amount) as service_count',
				'sum(request_service.amount)*service.cost as service_total',
				
			])->		
		from(['service', 'request_service', 'request'])->		
		
		andWhere ('service.id = request_service.id_service')->
		andWhere ('request.id = request_service.id_request')->		
		andWhere ('request.date_reg >= :date1 and request.date_reg < :date2')->
		groupby (['service.id', 'service.title', 'service.cost'])->
		orderby('service.title')->		
		params ([':date1'=>$User->report_date_1, ':date2'=>$User->report_date_2])
		;		
		
        $dataProvider = new ActiveDataProvider([
            'query' => $Q
			,
        ]);

        return $this->render('report-services-stat', [
            'dataProvider' => $dataProvider,
			'ReportParams' => User::findOne(Yii::$app->user->identity->id),
        ]);
    } 
	
?>
************************************************************************************************************************
��������������� ���� (Typeahead)
************************************************************************************************************************
<?php

			echo $form->field($model, 'recipient_city')->widget(kartik\widgets\TypeaheadBasic::classname(), [		
			'options' => ['placeholder' => '�������� ������'],
			'pluginOptions' => [
				'allowClear' => true,
				'minLength'=>2,
			],
			'data' => ArrayHelper::map(app\models\RbCity::find()->orderby(['title'=>'title asc'])->all(), 'title', 'title'),			
		]); 

?>
