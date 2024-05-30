<?php


namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\UserException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

// Класс-контроллер для отчетов системы
// http://nix-tips.ru/yii2-api-guides/guide-ru-structure-controllers.html
class ReportController extends \yii\web\Controller
{
	// Настройка поведения контроллера (права доступа)
	public function behaviors()
    {
        return [
			// права доступа
			'access' => [
				// класс, который реализует проверку прав доступа
				'class' => AccessControl::className(),
				// правила проверки прав доступа
				'rules' => 
				[	
					[
						// публичные действия контроллера, на которые распространяются правила
						'actions' => ['archive', 'document', 'document-list-by-kind', 'nomenclature'],						
						// разрешающее правило
						'allow' => true,
						// Могут просматривать только авторизованные пользователи
						'roles' => ['@'],
						// функция определяет, пользователи с какой ролью могут вызывать данные действия
						
						'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsAdmin || Yii::$app->user->identity->IsUser;
						}
						
					],				

					[
						// публичные действия контроллера, на которые распространяются правила
						'actions' => ['user-list'],						
						// разрешающее правило
						'allow' => true,
						// Могут просматривать только авторизованные пользователи
						'roles' => ['@'],
						// функция определяет, пользователи с какой ролью могут вызывать данные действия
						
						'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsAdmin;
						}
						
					],			
				],
			],					
        ];
    }
	
	// Метод настройки заголовка http-ответа (чтобы брайзер пользователя не открывал файл отчета (т.к. это должен делать Excel), а згружал его)
	public function SetHeader ($filename)
	{
		// содержимое и кодировка данных
		header('Content-Type: text/x-csv; charset=utf-8');
		// имя файла
		header('Content-Disposition: attachment;filename=' . $filename);
		// способ передачи
		header('Content-Transfer-Encoding: binary');		
	}
	
	
	
	public function actionUserList()
	{			
		$dataset = \app\models\User::find()->all();
		$this->SetHeader ('Список сотрудников.xls');
		
		return $this->renderPartial('user-list', [			
            'dataset' => $dataset,			
        ]);		  		
	}
	
	public function actionDocument($id)
	{			
		$model = DocumentController::findModel ($id);	
		$files = \app\models\File::find()->where(['id_document' => $model->id])->all();
		
		$this->SetHeader ('Карточка документа #' . $id . '.xls');				
		return $this->renderPartial('document', [	
			'model' => $model,            
			'files' => $files,
        ]);		  		
	}
	
	public function actionDocumentListByKind()
	{			
		$kinds = \app\models\DocumentKind::find()->all();
		$documents = \app\models\Document::find();		
		
		$this->SetHeader ('Cписок документов по видам.xls');				
		return $this->renderPartial('document-list-by-kind', [	
			'kinds' => $kinds,
			'mdocuments' => $documents,
        ]);		  		
	}
	
	public function actionArchive()
	{			
		$folders = \app\models\Folder::find()->all();
		$documents = \app\models\Document::find();		
		
		$this->SetHeader ('Архив.xls');				
		return $this->renderPartial('archive', [	
			'folders' => $folders,
			'mdocuments' => $documents,
        ]);		  		
	}	
	
	public function actionNomenclature()
	{		
		$folders = \app\models\Folder::find()->all();
		$documents = \app\models\Document::find();	
	
		$this->SetHeader ('Номенклатура дел.xls');				
		return $this->renderPartial('nomenclature', [
			'folders' => $folders,
			'mdocuments' => $documents,            
        ]);		  		
	}
	
	

}
