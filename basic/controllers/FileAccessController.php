<?php

namespace app\controllers;

use Yii;
use app\models\FileAccess;
use app\models\FileAccessSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * FileAccessController implements the CRUD actions for FileAccess model.
 */
class FileAccessController extends Controller
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
     * Lists all FileAccess models.
     * @return mixed
     */
    public function actionIndex($id_file)
    {
		$file = FileController::findModel ($id_file);	
		$file->TestAccess();
		
        $searchModel = new FileAccessSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere (['id_file' => $file->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'file' => $file,
        ]);
    }

    /**
     * Displays a single FileAccess model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$file = FileController::findModel ($model->id_file);
		$file->TestAccess();		
		
        return $this->render('view', [
            'model' => $model,
			'file' => $file,
        ]);
    }

    /**
     * Creates a new FileAccess model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_file)
    {
		$file = FileController::findModel ($id_file);	
		$file->TestAccess();
        $model = new FileAccess();		
		$model->id_file = $file->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {			
            return $this->render('create', [
                'model' => $model,
				'file' => $file,
            ]);
        }
    }

    /**
     * Updates an existing FileAccess model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$file = FileController::findModel ($model->id_file);	
		$file->TestAccess();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'file' => $file,
            ]);
        }
    }

    /**
     * Deletes an existing FileAccess model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);				
		$file = FileController::findModel ($model->id_file);	
		$file->TestAccess();
		$model->delete();
        return $this->redirect(['index', 'id_file' => $file->id]);
    }

    /**
     * Finds the FileAccess model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FileAccess the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FileAccess::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
