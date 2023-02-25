<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'cosmo';



AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['projectName'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	
	
	function MenuModules ()
	{
		//	
		$menu = [];			
		
		$menu[] = ['label' => Yii::t('app', 'Document Types'), 'url' => ['/document-type/index']];	
		$menu[] = ['label' => Yii::t('app', 'Materials'), 'url' => ['/material/index']];	
		$menu[] = ['label' => Yii::t('app', 'Image Loader'), 'url' => ['/image-loader/load']];	
		$menu[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];			
		return ['label' => Yii::t('app', 'Modules'), 'items' => $menu];
	}
		
	function MenuReports ()
	{		
		$menu = [];
		$menu[] = ['label' => Yii::t('app', 'Report Price List'), 'url' => ['/report/price-list']];		
		$menu[] = ['label' => Yii::t('app', 'Report Manager Work'), 'url' => ['/report/manager-work']];		
		$menu[] = ['label' => Yii::t('app', 'Report Request Journal'), 'url' => ['/report/request-journal']];			
		$menu[] = ['label' => Yii::t('app', 'Report Client Stat'), 'url' => ['/report/client-stat']];			
		
		
		
		
		return ['label' => Yii::t('app', 'Reports'), 'items'=>$menu];			
	}


	$items = [];
	
	$items[] = ['label' => Yii::t('app', 'Services'), 'url' => ['/service/index']];		
	$items[] = ['label' => Yii::t('app', 'Reviews'), 'url' => ['/review/index']];
		
	
	if (empty (Yii::$app->user->identity) == false)
	{
		switch (Yii::$app->user->identity->id_user_type)
		{
			case \app\models\User::USER_TYPE_ADMIN :
			{				
				$items[] = ['label' => Yii::t('app', 'Requests'), 'url' => ['/request/index']];	
				$items[] = ['label' => Yii::t('app', 'Documents'), 'url' => ['/document/index']];			
			
			} break;
		
			case \app\models\User::USER_TYPE_MANAGER :
			{				
				$items[] = ['label' => Yii::t('app', 'Requests'), 'url' => ['/request/index']];				
				$items[] = ['label' => Yii::t('app', 'Documents'), 'url' => ['/document/index']];				
		
			} break;
		
			case \app\models\User::USER_TYPE_CLIENT :
			{				
				$items[] = ['label' => Yii::t('app', 'Requests'), 'url' => ['/request/index']];				
			
			} break;
		}
		
		if (Yii::$app->user->identity->IsAdmin )
		{					
			
			$items[] = MenuModules();				
			
		}
	
		if (Yii::$app->user->identity->IsAdmin || Yii::$app->user->identity->IsManager)
		{				
			
						
			$items[] = MenuReports();	
		}
	}
	
	
	
	
	
	
	

	
	
	
	//$items[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']];			
	//$items[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
	//$items[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];
	
	$items[] = Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']] :
                [
                    'label' => Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
	
	
	
	
	
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items
    ]);
    NavBar::end();
    ?>

    <div class="container">
		<?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
		<?php
	
			foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
				echo '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
			}
		?>
        
        <?= $content ?>
    </div>
	
	
	
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->params['companyName'] ?> <?= date('Y') ?></p>
        <p class="pull-right">
		     
		</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
