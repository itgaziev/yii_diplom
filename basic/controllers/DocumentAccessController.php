<?php

namespace app\controllers;

use Yii;
use app\models\DocumentAccess;
use app\models\DocumentAccessSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * DocumentAccessController implements the CRUD actions for DocumentAccess model.
 */
class DocumentAccessController extends Controller
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
     * Lists all DocumentAccess models.
     * @return mixed
     */
    public function actionIndex($id_document)
    {
		$document = DocumentController::findModel ($id_document);	
		$document->TestAccess();		
		
        $searchModel = new DocumentAccessSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere (['id_document' => $document->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'document' => $document,
        ]);
    }

    /**
     * Displays a single DocumentAccess model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$document = DocumentController::findModel ($model->id_document);	
		$document->TestAccess();	
		
        return $this->render('view', [
            'model' => $model,
			'document' => $document,
        ]);
    }

    /**
     * Creates a new DocumentAccess model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_document)
    {
		$document = DocumentController::findModel ($id_document);	
		$document->TestAccess();	
		
        $model = new DocumentAccess();
		$model->id_document = $id_document;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
			
        } else {
            return $this->render('create', [
                'model' => $model,
				'document' => $document,
            ]);
        }
    }

    /**
     * Updates an existing DocumentAccess model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$document = DocumentController::findModel ($model->id_document);	
		$document->TestAccess();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'document' => $document,
            ]);
        }
    }

    /**
     * Deletes an existing DocumentAccess model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$document = DocumentController::findModel ($model->id_document);	
		$document->TestAccess();
		$model->delete();

        return $this->redirect(['index', 'id_document' => $document->id]);
    }

    /**
     * Finds the DocumentAccess model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocumentAccess the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocumentAccess::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
