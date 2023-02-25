<?php

namespace app\controllers;

use Yii;
use app\models\Document;
use app\models\DocumentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * Класс "DocumentController" реализует действия CRUD (сокр. от англ. create, read, update, delete — «создать, прочесть, обновить, удалить») для модели класса "Document".
 */
class DocumentController extends Controller
{
    /**
     * Метод, определяющий поведение контроллера (правила доступа к действиям контроллера)
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
						
						'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsManager || Yii::$app->user->identity->IsAdmin;
						}
						
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
     * Действие "download" реализует доступ к скачиванию файла.
     * @return mixed
     */
	public function actionDownload ($id)
	{
		$model = $this->findModel($id);		
		$storagePath = Yii::getAlias(Yii::$app->params['ContentDirectory']);
		$filename = $model->id . '.data';
		if (!is_file("$storagePath/$filename")) {
			throw new \yii\web\NotFoundHttpException(Yii::t('app', 'The file does not exists.'));		
		}
		return Yii::$app->response->sendFile("$storagePath/$filename", $model->file_name);				
	}
	

    /**
     * Действие "index" генерирует страницу вывода списка всех моделей класса "Document".
     * @return mixed 
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Действие "view" отображает данные конкретной модели класса "Document".
     * @param integer $id
     * @return mixed
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Действие "create" создает новый экземпляр класса "Document" (новую модель).
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу просмотра (действие 'view').
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Document();
		$model->registration_date = date ('Y-m-d H:i:s');
		$model->id_user = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->UploadFile();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Действие "update" реализует редактирование выбранной модели класса "Document".
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу просмотра (действие 'view').
     * @param integer $id
     * @return mixed
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->UploadFile();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Действие "delete" - удаление выбранной модели класса "Document".
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу 'index'.
     * @param integer $id
     * @return mixed
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		
		$model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Метод поиска модели класса "Document" по первичному ключу.
     * Если модель не найдена, выдает исключение HTTP 404.
     * @param integer $id
     * @return Объект класса "Document" (модель)
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public static function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
