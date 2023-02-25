<?php

namespace app\controllers;

use Yii;
use app\models\Review;
use app\models\ReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * Класс "ReviewController" реализует действия CRUD (сокр. от англ. create, read, update, delete — «создать, прочесть, обновить, удалить») для модели класса "Review".
 */
class ReviewController extends Controller
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
						'actions' => ['index'],
						'allow' => true,
						'roles' => ['?'],						
					],		
					[
						'actions' => ['index', 'view', 'create', 'update', 'delete'],
						'allow' => true,
						'roles' => ['@'],	
						
						/*
						'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsAdmin;
						}
						*/
						
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
     * Действие "index" генерирует страницу вывода списка всех моделей класса "Review".
     * @return mixed 
     */
    public function actionIndex()
    {
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		if (!empty (Yii::$app->user->identity)) {
			
			if (!Yii::$app->user->identity->IsAdmin && !Yii::$app->user->identity->IsManager) {
				$dataProvider->query->andWhere(['id_review_status' => 4])->orWhere(['id_user' => Yii::$app->user->identity->id]);
			}			
		}
		else
		{
			$dataProvider->query->andWhere(['id_review_status' => 4]);
		}
		
		

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Действие "view" отображает данные конкретной модели класса "Review".
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
     * Действие "create" создает новый экземпляр класса "Review" (новую модель).
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу просмотра (действие 'view').
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Review();
		$model->registration_date = date ('Y-m-d H:i:s');
		$model->id_user = Yii::$app->user->identity->id;
		$model->id_review_status = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Действие "update" реализует редактирование выбранной модели класса "Review".
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
     * Действие "delete" - удаление выбранной модели класса "Review".
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
     * Метод поиска модели класса "Review" по первичному ключу.
     * Если модель не найдена, выдает исключение HTTP 404.
     * @param integer $id
     * @return Объект класса "Review" (модель)
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public static function findModel($id)
    {
		$mode = null;
		if (!Yii::$app->user->identity->IsAdmin && !Yii::$app->user->identity->IsManager) {			
			$model = Review::find()->andWhere(['id' => $id, 'id_review_status' => 1, 'id_user' => Yii::$app->user->identity->id])->one();
			if ($model !== null) {
				return $model;
			}			
			throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
		}
		else
		{
			if (($model = Review::findOne($id)) !== null) {
				return $model;
			}
			throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
		}

        
    }
}
