<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\UserException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
		
			'access' => [
				'class' => AccessControl::className(),
				'rules' => 
				[	
					[
						'actions' => ['view', 'update'],
						'allow' => true,
						'roles' => ['@'],
						/*
						'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsAdmin;
						}
						*/
					],				

					[
						'actions' => ['index', 'view', 'create', 'update', 'delete'],
						'allow' => true,
						'roles' => ['@'],						
						'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsAdmin;
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

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
		$model->scenario = 'create';		
        if ($model->load(Yii::$app->request->post())) 
		{		
			if ($model->password_new == '')			
				throw new UserException ('Пароль не задан');							
			if ($model->password_new != $model->password_confirmation)			
				throw new UserException ('Пароль и подтверждение пароля не совпадают');							
			$model->generateAuthKey();
			$model->generateActivationToken();		
			$model->setPassword($model->password_new);			
			$model->password_str = $model->password_new;
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
			$model->id_user_type = User::USER_TYPE_EXECUTOR;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);				
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
		{
			if (empty($model->password_new) == false || empty($model->password_confirmation) == false)				
			{
				if ($model->password_new != $model->password_confirmation)			
					throw new UserException ('Пароль и подтверждение пароля не совпадают');		
				$model->setPassword($model->password_new);		
				$model->password_str = $model->password_new;
				$model->save();
			}
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
		$model = User::findOne($id);
        if (($model) !== null) {
			if (Yii::$app->user->identity->IsAdmin == false and Yii::$app->user->identity->id != $model->id)
				throw new UserException(Yii::t('app', 'Access denied'));
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
