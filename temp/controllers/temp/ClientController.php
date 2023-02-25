<?php

namespace app\controllers;

use Yii;
use app\models\Client;
use app\models\ClientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * Класс "ClientController" реализует действия CRUD (сокр. от англ. create, read, update, delete — «создать, прочесть, обновить, удалить») для модели класса "Client".
 */
class ClientController extends Controller
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
     * Действие "index" генерирует страницу вывода списка всех моделей класса "Client".
     * @return mixed 
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Действие "view" отображает данные конкретной модели класса "Client".
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
     * Действие "create" создает новый экземпляр класса "Client" (новую модель).
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу просмотра (действие 'view').
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Client();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Действие "update" реализует редактирование выбранной модели класса "Client".
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу просмотра (действие 'view').
     * @param integer $id
     * @return mixed
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Действие "delete" - удаление выбранной модели класса "Client".
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
     * Метод поиска модели класса "Client" по первичному ключу.
     * Если модель не найдена, выдает исключение HTTP 404.
     * @param integer $id
     * @return Объект класса "Client" (модель)
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public static function findModel($id)
    {
		$model = Client::find()->where(['id' => $id]);
		if (!Yii::$app->user->identity->IsAdmin) {
			$model->where(['id' => Yii::$app->user->identity->id]);
		}
		$model = $model->one();
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
