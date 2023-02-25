<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * Класс "<?= $controllerClass ?>" реализует действия CRUD (сокр. от англ. create, read, update, delete — «создать, прочесть, обновить, удалить») для модели класса "<?= $modelClass ?>".
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
	

    /**
     * Действие "index" генерирует страницу вывода списка всех моделей класса "<?= $modelClass ?>".
     * @return mixed 
     */
    public function actionIndex()
    {
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
<?php endif; ?>
    }

    /**
     * Действие "view" отображает данные конкретной модели класса "<?= $modelClass ?>".
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public function actionView(<?= $actionParams ?>)
    {
		$model = $this->findModel(<?= $actionParams ?>);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Действие "create" создает новый экземпляр класса "<?= $modelClass ?>" (новую модель).
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу просмотра (действие 'view').
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new <?= $modelClass ?>();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', <?= $urlParams ?>]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Действие "update" реализует редактирование выбранной модели класса "<?= $modelClass ?>".
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу просмотра (действие 'view').
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public function actionUpdate(<?= $actionParams ?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', <?= $urlParams ?>]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Действие "delete" - удаление выбранной модели класса "<?= $modelClass ?>".
     * Если операция успешно выполнена, браузер будет перенаправлен на страницу 'index'.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public function actionDelete(<?= $actionParams ?>)
    {
        $model = $this->findModel(<?= $actionParams ?>);
		
		$model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Метод поиска модели класса "<?= $modelClass ?>" по первичному ключу.
     * Если модель не найдена, выдает исключение HTTP 404.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return Объект класса "<?=                   $modelClass ?>" (модель)
     * @throws Возвращает исключение класса "NotFoundHttpException", если модель не найдена
     */
    public static function findModel(<?= $actionParams ?>)
    {
<?php
if (count($pks) === 1) {
    $condition = '$id';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
        if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(<?= $generator->generateString('The requested page does not exist.') ?>);
    }
}
