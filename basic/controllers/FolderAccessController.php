<?php

namespace app\controllers;

use Yii;
use app\models\FolderAccess;
use app\models\FolderAccessSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * FolderAccessController implements the CRUD actions for FolderAccess model.
 */
class FolderAccessController extends Controller
{
    /**
     * @inheritdoc
     */
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
					],			
				],
			],			
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FolderAccess models.
     * @return mixed
     */
    public function actionIndex($id_folder)
    {
		$folder = FolderController::findModel ($id_folder);	
		$folder->TestAccess();		
		
        $searchModel = new FolderAccessSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere (['id_folder' => $folder->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'folder' => $folder,
        ]);
    }

    /**
     * Displays a single FolderAccess model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$folder = FolderController::findModel ($model->id_folder);	
		$folder->TestAccess();		
		
        return $this->render('view', [
            'model' => $model,
			'folder' => $folder,
        ]);
    }

    /**
     * Creates a new FolderAccess model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_folder)
    {
		$folder = FolderController::findModel ($id_folder);	
		$folder->TestAccess();			
        $model = new FolderAccess();
		$model->id_folder = $folder->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {			
            return $this->redirect(['view', 'id' => $model->id]);
        } else {			
            return $this->render('create', [
                'model' => $model,
				'folder' => $folder,
            ]);
        }
    }

    /**
     * Updates an existing FolderAccess model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$folder = FolderController::findModel ($model->id_folder);	
		$folder->TestAccess();		

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'folder' => $folder,
            ]);
        }
    }

    /**
     * Deletes an existing FolderAccess model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		
		$model = $this->findModel($id);				
		$folder = FolderController::findModel ($model->id_folder);	
		$folder->TestAccess();	
		$model->delete();

        return $this->redirect(['index', 'id_folder' => $folder->id]);
    }

    /**
     * Finds the FolderAccess model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FolderAccess the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FolderAccess::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
