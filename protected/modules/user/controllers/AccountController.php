<?php

/**
 * Контроллер, отвечающий за регистрацию, авторизацию и т.д. действия неавторизованного пользователя
 *
 * @category YupeComponents
 * @package  yupe.modules.user.controllers
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     http://yupe.ru
 *
 **/
class AccountController extends \yupe\components\controllers\FrontController
{
    public function filters()
    {
        return [
            'accessControl',
        ];
    }

    public function accessRules()
    {
        return [
            ['allow',
                'actions' => ['logout'],
                'users' => ['*']
            ],
			['allow',
				'actions' => ['subscribe'],
				'users' => ['@']
			],
            ['deny',
                'actions'=>[],
                'users'=>['@']
            ],
        ];
    }
	
	public function actionSubscribe()
	{
		if(Yii::app()->user->isGuest) {
			$this->redirect(['/user/account/registration']);
		}
		$user = Yii::app()->user->profile;
		
		$form = new SubscribeForm();
		$form->setAttributes($user->getAttributes());
		
		if(isset($_POST['SubscribeForm'])) {
			$form->setAttributes($_POST['SubscribeForm']);
	
			if($form->validate()) {
				
				$user->setAttributes($form->getAttributes());
				$user->subscribe_time = time();
				
				if($user->save(false, ['subscribe_status'])) {
					$this->redirect(['/music/default/index']);
				} else {
					print_r($user->getErrors());
				}
			}
		}
		
		
		$this->render('subscribe', ['model' => $form]);
	}

    public function actions()
    {
        return [
            'captcha'         => [
                'class'     => 'yupe\components\actions\YCaptchaAction',
                'backColor' => 0xFFFFFF,
                'testLimit' => 1,
                'minLength' => Yii::app()->getModule('user')->minCaptchaLength,
            ],
            'registration'    => [
                'class' => 'application.modules.user.controllers.account.RegistrationAction',
            ],
            'activate'        => [
                'class' => 'application.modules.user.controllers.account.ActivateAction',
            ],
            'login'           => [
                'class' => 'application.modules.user.controllers.account.LoginAction',
            ],
            'backendlogin'    => [
                'class' => 'application.modules.user.controllers.account.LoginAction',
            ],
            'logout'          => [
                'class' => 'application.modules.user.controllers.account.LogOutAction',
            ],
            'recovery'        => [
                'class' => 'application.modules.user.controllers.account.RecoveryAction',
            ],
            'restore'         => [
                'class' => 'application.modules.user.controllers.account.RecoveryPasswordAction',
            ],
            'confirm'         => [
                'class' => 'application.modules.user.controllers.account.EmailConfirmAction',
            ],
        ];
    }
}
