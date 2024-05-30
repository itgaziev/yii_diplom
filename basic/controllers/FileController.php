<?php

namespace app\controllers;

use Yii;
use app\models\File;
use app\models\FileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\base\UserException;	

/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends Controller
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
						'actions' => ['index', 'view', 'create', 'update', 'delete', 'download'],
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
	
	public function LoadFile (&$model)
    {					
		$files = UploadedFile::getInstances($model, 'ffile');	
		if (count ($files) > 0)
		{
			$file = $files[0];
			$FileDirectory = Yii::$app->params['FileDirectory'] . '/';				
			if (file_exists($FileDirectory) == false)			
				mkdir ($FileDirectory, 0777, true);	
			$file_name = $FileDirectory . $model->id . '.data';					
			if ($file->saveAs ($file_name) == false)
			{				
				throw new UserException ('Не удалось загрузить файл');
			}			
			$model->filename = $file->baseName . '.' . $file->extension;					
			$model->size = $file->size;		
			$model->save();
		}
    }
	
	public function actionDownload($id)
    {		
		$model = $this->findModel($id);
		$model->TestAccessByFlag('flag_view');
		
		$file_name = Yii::$app->params['FileDirectory'] . '/' . $model->id . '.data';		
		if (empty ($model->filename) == false && file_exists($file_name))
		{
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment;filename=" . $model->filename);
			header('Content-Transfer-Encoding: binary');	
			readfile($file_name);
		}
		else
		{
			throw new UserException ('Файл не найден');
		}
    }

    /**
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex($id_document)
    {
		$document = DocumentController::findModel($id_document);
		$document->TestAccessByFlag('flag_view');
		$folder = FolderController::findModel($document->id_folder);		
        $searchModel = new FileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere (['id_document' => $id_document]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'folder' => $folder,
			'document' => $document,
        ]);
    }

    /**
     * Displays a single File model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$model->TestAccessByFlag('flag_view');
		$document = DocumentController::findModel($model->id_document);
		$folder = FolderController::findModel($document->id_folder);
        return $this->render('view', [
            'model' => $model,
			'folder' => $folder,
			'document' => $document,
        ]);
    }

    /**
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_document)
    {
		$document = DocumentController::findModel($id_document);
		$document->TestAccessByFlag('flag_edit');
		$folder = FolderController::findModel($document->id_folder);
        $model = new File();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->registration_date = date('Y-m-d h:i:s');
			$model->id_user = Yii::$app->user->identity->id;
			$model->save();
			$this->LoadFile ($model);	
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
			$model->id_document = $document->id;
            return $this->render('create', [
                'model' => $model,
				'folder' => $folder,
				'document' => $document,
            ]);
        }
    }

    /**
     * Updates an existing File model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {	
        $model = $this->findModel($id);
		$model->TestAccessByFlag('flag_edit');		
		$document = DocumentController::findModel($model->id_document);
		$folder = FolderController::findModel($document->id_folder);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {					
			$this->LoadFile ($model);			
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'folder' => $folder,
				'document' => $document,
            ]);
        }
    }

    /**
     * Deletes an existing File model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {        
		$model = $this->findModel($id);
		$model->TestAccessByFlag('flag_delete');
		$document = DocumentController::findModel($model->id_document);
		$model->delete();
        return $this->redirect(['index', 'id_document' => $document->id]);
    }

    /**
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) 
		{	
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
}
