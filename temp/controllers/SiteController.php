<?php
namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Request;
use app\models\RequestSearch;
use app\models\Quest;

use yii\data\ActiveDataProvider;
use app\code\KMeans;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'activation', 'index'],
                'rules' => [
                    [
                        'actions' => ['signup', 'activation'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],					
                    [
                        'actions' => ['logout', 'authorize'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                       
                    ],			
					
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }	
	
	/*
	public function beforeAction($action)
	{             
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}
	*/

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {	
	
		
		// prepare 50 2D points to be clustered
$points = [
	[80,55],[86,59],[19,85],[41,47],[57,58],
	[76,22],[94,60],[13,93],[90,48],[52,54],
	[62,46],[88,44],[85,24],[63,14],[51,40],
	[75,31],[86,62],[81,95],[47,22],[43,95],
	[71,19],[17,65],[69,21],[59,60],[59,12],
	[15,22],[49,93],[56,35],[18,20],[39,59],
	[50,15],[81,36],[67,62],[32,15],[75,65],
	[10,47],[75,18],[13,45],[30,62],[95,79],
	[64,11],[92,14],[94,49],[39,13],[60,68],
	[62,10],[74,44],[37,42],[97,60],[47,73],
];
$n = count($points);
/*
echo "Initialize points...\n";

$points = [];
for ($i=0; $i < $n = 100; $i++) {
	$points[] = [mt_rand(0, 100), mt_rand(0, 100)];
	printf("\r%.2f%%", ($i / $n) * 100);
}

echo "\nDone.";
echo "\nCreating Space...\n";
*/

// create a 2-dimentions space
$space = new KMeans\Space(2);

// add points to space
foreach ($points as $i => $coordinates) {
	$space->addPoint($coordinates);
	printf("\r%.2f%%", ($i / $n) * 100);
}

echo "done.\n";
echo "Determining clusters";

// cluster these 50 points in 3 clusters
$clusters = $space->solve(3, KMeans\Space::SEED_DEFAULT, function () {
	echo ".";
});

echo "<br>";
echo "<br>";

// display the cluster centers and attached points


foreach ($clusters as $i => $cluster) {
	echo "<br>";
	
	printf("Cluster %s [%d,%d]: %d points\n", $i, $cluster[0], $cluster[1], count($cluster));
	echo "<br>";
	
	foreach ($cluster->getIterator() as $j => $point) {
		print_r ($point->toArray());
		echo "<br>";
	}
	
	
		
}	
	
		//return $this->redirect ('product/index');
		/*
		$model = Yii::$app->user->identity;
        return $this->render('index', [
            'model' => $model,
        ]);	
		*/
		
		return;
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) 
		{
			return $this->goBack();
			/*
			if (\Yii::$app->user->identity->IsUser)
			{
				return $this->goBack();				
			}
			else
			{
				return $this->goHome();
			}
			*/
			return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
	
	


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'There was an error sending email.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	
	public function actionActivation ($token)
	{
		$model = \app\models\User::findByActivationToken ($token);
		if (empty($model) == true)
			throw new BadRequestHttpException(Yii::t('app', 'Bad activation token'));		
		$model->removeActivationToken();
		$model->status = \app\models\User::STATUS_ACTIVE;
		if ($model->Save())
		{
			if (Yii::$app->getUser()->login($model)) 
			{
                //return $this->goHome();
				Yii::$app->session->setFlash('success', Yii::t('app', 'Activation successfully completed'));
				
            }
		}
		return $this->goHome();
	}
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) 
		{	
            if ($user = $model->signup()) 
			{
				Yii::$app->session->setFlash('success', Yii::t('app', 'Check your email for further instructions.'));				
                if (Yii::$app->getUser()->login($user)) 
				{
                    
                }
				return $this->goHome();				
            }			
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Check your email for further instructions.'));
				

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Sorry, we are unable to reset password for email provided.'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'New password was saved.'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
					