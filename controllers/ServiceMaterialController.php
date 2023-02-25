<?php

namespace app\controllers;

use Yii;
use app\models\ServiceMaterial;
use app\models\ServiceMaterialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * Класс "ServiceMaterialController" реализует действия CRUD (сокр. от англ. create, read, update, delete — «создать, прочесть, обновить, удалить») для модели класса "ServiceMaterial".
 */
class ServiceMaterialController extends Controller
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
							return Yii::$app->user->identity->IsAdmin ;
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
     * Действие "index" генерирует страницу вывода списка всех моделей класса "ServiceMaterial".
     * @return mixed 
     */
    public function actionIndex($id_service)
    {
		$service = ServiceController::findModel($id_service);	
        $searchModel = new ServiceMaterialSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['id_service' => $service ->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'service' => $service,
        ]);
    }

    /**
     * Действие "view" отображает данные конкретной модели класса "ServiceMaterial".
     * @param integer $id
     * @return mixed
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$service = ServiceController::findModel($model->id_service);	
        return $this->render('view', [
            'model' => $model,
			'service' => $service,
        ]);
    }

    /**
     * Действие "create" создает новый экземпляр класса "ServiceMaterial" (новую модель).
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу просмотра (действие 'view').
     * @return mixed
     */
    public function actionCreate($id_service)
    {
		$service = ServiceController::findModel($id_service);	
        $model = new ServiceMaterial();
		$model->id_service = $service->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
			'service' => $service,
        ]);
    }

    /**
     * Действие "update" реализует редактирование выбранной модели класса "ServiceMaterial".
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу просмотра (действие 'view').
     * @param integer $id
     * @return mixed
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$service = ServiceController::findModel($model->id_service);	

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
			'service' => $service,
        ]);
    }

    /**
     * Действие "delete" - удаление выбранной модели класса "ServiceMaterial".
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу 'index'.
     * @param integer $id
     * @return mixed
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$service = ServiceController::findModel($model->id_service);	
		$model->delete();

        return $this->redirect(['index', 'id_service' => $service->id]);
    }

    /**
     * Метод поиска модели класса "ServiceMaterial" по первичному ключу.
     * Если модель не найдена, выдает исключение HTTP 404.
     * @param integer $id
     * @return Объект класса "ServiceMaterial" (модель)
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public static function findModel($id)
    {
        if (($model = ServiceMaterial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
