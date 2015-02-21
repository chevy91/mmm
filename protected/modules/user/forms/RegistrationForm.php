<?php

/**
 * Форма регистрации
 *
 * @category YupeComponents
 * @package  yupe.modules.user.forms
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     http://yupe.ru
 *
 **/
class RegistrationForm extends CFormModel
{

    public $nick_name;
    public $email;
    public $password;
    public $cPassword;
    public $verifyCode;
	
	public $first_name;
	public $last_name;
	public $zip;
	public $phone;
	public $address;
	public $country;
	public $dj_name;
	public $club_residencies;
	public $radios_residencies;

    public $disableCaptcha = false;

    public function isCaptchaEnabled()
    {
        $module = Yii::app()->getModule('user');

        if (!$module->showCaptcha || !CCaptcha::checkRequirements() || $this->disableCaptcha) {
            return false;
        }

        return true;
    }

    public function rules()
    {
        $module = Yii::app()->getModule('user');

        return [
			['dj_name, first_name, last_name, zip, phone, country', 'required'],
			['club_residencies, radios_residencies, address', 'safe'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'filter', 'filter' => [new CHtmlPurifier(), 'purify']],
            ['email, password, cPassword', 'required'],
            ['email', 'length', 'max' => 50],
            ['password, cPassword', 'length', 'min' => $module->minPasswordLength],
            [
                'cPassword',
                'compare',
                'compareAttribute' => 'password',
                'message'          => Yii::t('UserModule.user', 'Password is not coincide')
            ],
            ['email', 'email'],
            ['email', 'checkEmail'],
            [
                'verifyCode',
                'yupe\components\validators\YRequiredValidator',
                'allowEmpty' => !$this->isCaptchaEnabled(),
                'message'    => Yii::t('UserModule.user', 'Check code incorrect')
            ],
            ['verifyCode', 'captcha', 'allowEmpty' => !$this->isCaptchaEnabled()],
            ['verifyCode', 'emptyOnInvalid']
        ];
    }

    public function attributeLabels()
    {
        return [
            'nick_name'  => Yii::t('UserModule.user', 'User name'),
            'email'      => Yii::t('UserModule.user', 'Email'),
            'password'   => Yii::t('UserModule.user', 'Password'),
            'cPassword'  => Yii::t('UserModule.user', 'Password confirmation'),
            'verifyCode' => Yii::t('UserModule.user', 'Check code'),
        ];
    }

    public function checkNickName($attribute, $params)
    {
        $model = User::model()->find('nick_name = :nick_name', [':nick_name' => $this->$attribute]);

        if ($model) {
            $this->addError('nick_name', Yii::t('UserModule.user', 'User name already exists'));
        }
    }

    public function checkEmail($attribute, $params)
    {
        $model = User::model()->find('email = :email', [':email' => $this->$attribute]);

        if ($model) {
            $this->addError('email', Yii::t('UserModule.user', 'Email already busy'));
        }
    }

    public function emptyOnInvalid($attribute, $params)
    {
        if ($this->hasErrors()) {
            $this->verifyCode = null;
        }
    }
}
