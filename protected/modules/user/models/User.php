<?php

/**
 * This is the model class for table "{{user_user}}".
 *
 * The followings are the available columns in table '{{user_user}}':
 * @property integer $id
 * @property string  $change_date
 * @property string  $first_name
 * @property string  $middle_name
 * @property string  $last_name
 * @property string  $nick_name
 * @property string  $email
 * @property integer $gender
 * @property string  $avatar
 * @property string  $password
 * @property integer $status
 * @property integer $access_level
 * @property string  $last_visit
 * @property boolean $email_confirm
 * @property string  $registration_date
 *
 */
class User extends yupe\models\YModel
{
	const STATUS_SUBSCRIBED_FOR_YEAR = 2;
	const STATUS_SUBSCRIBED_FOR_MONTH = 1;
	const STATUS_UNSUBSCRIBED = 0;
	
    /**
     *
     */
    const GENDER_THING = 0;
    /**
     *
     */
    const GENDER_MALE = 1;
    /**
     *
     */
    const GENDER_FEMALE = 2;

    /**
     *
     */
    const STATUS_BLOCK = 0;
    /**
     *
     */
    const STATUS_ACTIVE = 1;
    /**
     *
     */
    const STATUS_NOT_ACTIVE = 2;

    /**
     *
     */
    const EMAIL_CONFIRM_NO = 0;
    /**
     *
     */
    const EMAIL_CONFIRM_YES = 1;

    /**
     *
     */
    const ACCESS_LEVEL_USER = 0;
    /**
     *
     */
    const ACCESS_LEVEL_ADMIN = 1;

    /**
     * @var
     */
    private $_oldAccess_level;
    /**
     * @var
     */
    private $_oldStatus;
    /**
     * @var bool
     */
    public $use_gravatar = false;
	
	public function canDownload()
	{
		return $this->subscribe_status == self::STATUS_SUBSCRIBED_FOR_MONTH
			|| $this->subscribe_status == self::STATUS_SUBSCRIBED_FOR_YEAR;
	}

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user_user}}';
    }

    /**
     * Returns the static model of the specified AR class.
     *
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $module = Yii::app()->getModule('user');

        return [
			['first_name, last_name, zip, phone, country', 'required'],
			['dj_name, club_residencies, radios_residencies, address, subscribe_status', 'safe'],
            [
                'first_name, last_name, email, dj_name',
                'filter',
                'filter' => 'trim'
            ],
            [
                'first_name, last_name, email',
                'filter',
                'filter' => [$obj = new CHtmlPurifier(), 'purify']
            ],
            ['email, hash', 'required'],
            ['first_name, last_name, email', 'length', 'max' => 50],
            ['hash', 'length', 'max' => 256],

            ['status, access_level', 'numerical', 'integerOnly' => true],
            //['gender', 'default', 'value' => self::GENDER_THING, 'setOnEmpty' => true],
            //['site', 'url', 'allowEmpty' => true],
            ['email', 'email'],
            ['email', 'unique', 'message' => Yii::t('UserModule.user', 'This email already use by another user')],
           /* [
                'avatar',
                'file',
                'types' => $module->avatarExtensions,
                'maxSize' => $module->avatarMaxSize,
                'allowEmpty' => true,
                'safe' => false
            ], */
            ['email_confirm', 'in', 'range' => array_keys($this->getEmailConfirmStatusList())],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            ['registration_date', 'length', 'max' => 50],
            [
                'id, change_date, first_name, last_name, email, status, access_level, last_visit',
                'safe',
                'on' => 'search'
            ],
            //['birth_date', 'default', 'setOnEmpty' => true, 'value' => null],
            ['registration_date', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'insert'],
            ['change_date', 'default', 'value' => new CDbExpression('NOW()'), 'on' => 'update']
        ];
    }

    /**
     * Массив связей:
     *
     * @return array
     */
    public function relations()
    {
        return [
            // Все токены пользователя:
            'tokens' => [
                self::HAS_MANY,
                'UserToken',
                'user_id'
            ]
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('UserModule.user', 'Id'),
            'creation_date' => Yii::t('UserModule.user', 'Activated at'),
            'change_date' => Yii::t('UserModule.user', 'Updated at'),
            'first_name' => Yii::t('UserModule.user', 'Your First Name'),
            'last_name' => Yii::t('UserModule.user', 'Your Last Name'),
            //'middle_name' => Yii::t('UserModule.user', 'Family name'),
            'full_name' => Yii::t('UserModule.user', 'Full name'),
            'nick_name' => Yii::t('UserModule.user', 'Nick'),
            'email' => Yii::t('UserModule.user', 'Your Email'),
            'gender' => Yii::t('UserModule.user', 'Sex'),
            'password' => Yii::t('UserModule.user', 'Password'),
            'status' => Yii::t('UserModule.user', 'Status'),
            'access_level' => Yii::t('UserModule.user', 'Access'),
            'last_visit' => Yii::t('UserModule.user', 'Last visit'),
            'registration_date' => Yii::t('UserModule.user', 'Register date'),
            'registration_ip' => Yii::t('UserModule.user', 'Register Ip'),
            'activation_ip' => Yii::t('UserModule.user', 'Activation Ip'),
            'activate_key' => Yii::t('UserModule.user', 'Activation code'),
            'avatar' => Yii::t('UserModule.user', 'Avatar'),
            'use_gravatar' => Yii::t('UserModule.user', 'Gravatar'),
            'email_confirm' => Yii::t('UserModule.user', 'Email was confirmed'),
            'birth_date' => Yii::t('UserModule.user', 'Birthday'),
            'site' => Yii::t('UserModule.user', 'Site/blog'),
            'location' => Yii::t('UserModule.user', 'Location'),
            'about' => Yii::t('UserModule.user', 'About yourself'),
			
			
			'phone' => Yii::t('UserModule.user', 'Phone'),
			'address' => Yii::t('UserModule.user', 'Address'),
			'country' => Yii::t('UserModule.user', 'Country'),
			'zip' => Yii::t('UserModule.user', 'Zip'),
			'dj_name' => Yii::t('UserModule.user', 'Dj Name'),
			'club_residencies' => Yii::t('UserModule.user', 'Clubs Residencies'),
			'radios_residencies' => Yii::t('UserModule.user', 'Radios Residencies'),
			'subscribe_status' => Yii::t('UserModule.user', 'Subscribe Status'),
			'subscribe_time' => Yii::t('UserModule.user', 'Subscribe Time'),
        ];
    }

    /**
     * Проверка верификации почты:
     *
     * @return boolean
     */
    public function getIsVerifyEmail()
    {
        return $this->email_confirm;
    }

    /**
     * Строковое значение верификации почты пользователя:
     *
     * @return string
     */
    public function getIsVerifyEmailStatus()
    {
        return $this->getIsVerifyEmail()
            ? Yii::t('UserModule.user', 'Yes')
            : Yii::t('UserModule.user', 'No');
    }

    /**
     * Поиск пользователей по заданным параметрам:
     *
     * @return CActiveDataProvider
     */
    public function search($pageSize = 10)
    {
        $criteria = new CDbCriteria();

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.change_date', $this->change_date, true);
        if ($this->registration_date) {
            $criteria->compare('t.registration_date', date('Y-m-d', strtotime($this->registration_date)), true);
        }
        $criteria->compare('t.first_name', $this->first_name, true);
       // $criteria->compare('t.middle_name', $this->first_name, true);
        $criteria->compare('t.last_name', $this->last_name, true);
        $criteria->compare('t.nick_name', $this->nick_name, true);
        $criteria->compare('t.email', $this->email, true);
        //$criteria->compare('t.gender', $this->gender);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.access_level', $this->access_level);
        if ($this->last_visit) {
            $criteria->compare('t.last_visit', date('Y-m-d', strtotime($this->last_visit)), true);
        }
        $criteria->compare('t.email_confirm', $this->email_confirm);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                'defaultOrder' => 'last_visit DESC',
            ]
        ]);
    }

    /**
     * Метод после поиска:
     *
     * @return void
     */
    public function afterFind()
    {
        $this->_oldAccess_level = $this->access_level;
        $this->_oldStatus = $this->status;
        // Если пустое поле аватар - автоматически
        // включаем граватар:
        $this->use_gravatar = empty($this->avatar);

        return parent::afterFind();
    }


    /**
     * Метод выполняемый перед сохранением:
     *
     * @return bool
     */
    public function beforeSave()
    {
        if (!$this->getIsNewRecord() && $this->_oldAccess_level === self::ACCESS_LEVEL_ADMIN) {
            // Запрещаем действия, при которых администратор
            // может быть заблокирован или сайт останется без
            // администратора:
            if (
                $this->admin()->count() == 1
                && ((int)$this->access_level === self::ACCESS_LEVEL_USER || (int)$this->status !== self::STATUS_ACTIVE)
            ) {
                $this->addError(
                    'access_level',
                    Yii::t('UserModule.user', 'You can\'t make this changes!')
                );

                return false;
            }
        }

        return parent::beforeSave();
    }


    /**
     * Метод перед удалением:
     *
     * @return bool
     */
    public function beforeDelete()
    {
        if ($this->_oldAccess_level == self::ACCESS_LEVEL_ADMIN && $this->admin()->count() == 1) {
            $this->addError(
                'access_level',
                Yii::t('UserModule.user', 'You can\'t make this changes!')
            );

            return false;
        }

        return parent::beforeDelete();
    }

    /**
     * Именнованные условия:
     *
     * @return array
     */
    public function scopes()
    {
        return [
            'active' => [
                'condition' => 't.status = :user_status',
                'params' => [
                    ':user_status' => self::STATUS_ACTIVE
                ],
            ],
            'registered' => [
                'condition' => 't.status = :user_status',
                'params' => [
                    ':user_status' => self::STATUS_NOT_ACTIVE
                ],
            ],
            'blocked' => [
                'condition' => 'status = :blocked_status',
                'params' => [':blocked_status' => self::STATUS_BLOCK],
            ],
            'admin' => [
                'condition' => 'access_level = :access_level',
                'params' => [':access_level' => self::ACCESS_LEVEL_ADMIN],
            ],
            'user' => [
                'condition' => 'access_level = :access_level',
                'params' => [':access_level' => self::ACCESS_LEVEL_USER],
            ],
        ];
    }

    /**
     * Список текстовых значений ролей:
     *
     * @return array
     */
    public function getAccessLevelsList()
    {
        return [
            self::ACCESS_LEVEL_ADMIN => Yii::t('UserModule.user', 'Administrator'),
            self::ACCESS_LEVEL_USER => Yii::t('UserModule.user', 'User'),
        ];
    }

    /**
     * Получаем строковое значение роли
     * пользователя:
     *
     * @return string
     */
    public function getAccessLevel()
    {
        $data = $this->getAccessLevelsList();

        return isset($data[$this->access_level]) ? $data[$this->access_level] : Yii::t('UserModule.user', '*no*');
    }

    /**
     * Список возможных статусов пользователя:
     *
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('UserModule.user', 'Active'),
            self::STATUS_BLOCK => Yii::t('UserModule.user', 'Blocked'),
            self::STATUS_NOT_ACTIVE => Yii::t('UserModule.user', 'Not activated'),
        ];
    }

    /**
     * Получение строкового значения
     * статуса пользователя:
     *
     * @return string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status])
            ? $data[$this->status]
            : Yii::t('UserModule.user', 'status is not set');
    }

    /**
     * @return array
     */
    public function getEmailConfirmStatusList()
    {
        return [
            self::EMAIL_CONFIRM_YES => Yii::t('UserModule.user', 'Yes'),
            self::EMAIL_CONFIRM_NO => Yii::t('UserModule.user', 'No'),
        ];
    }

    /**
     * @return string
     */
    public function getEmailConfirmStatus()
    {
        $data = $this->getEmailConfirmStatusList();

        return isset($data[$this->email_confirm]) ? $data[$this->email_confirm] : Yii::t(
            'UserModule.user',
            '*unknown*'
        );
    }
	
	public function getSubscribeList()
    {
        return [
			self::STATUS_UNSUBSCRIBED => Yii::t('UserModule.user', 'Not subscribed'),
			self::STATUS_SUBSCRIBED_FOR_MONTH => Yii::t('UserModule.user', 'Subscribed for 1 month'),
			self::STATUS_SUBSCRIBED_FOR_YEAR => Yii::t('UserModule.user', 'Subscribed for 1 year'),
        ];
    }

    /**
     * Список статусов половой принадлежности:
     *
     * @return array
     */
    public function getGendersList()
    {
        return [
            self::GENDER_FEMALE => Yii::t('UserModule.user', 'female'),
            self::GENDER_MALE => Yii::t('UserModule.user', 'male'),
            self::GENDER_THING => Yii::t('UserModule.user', 'not set'),
        ];
    }

    /**
     * Получаем строковое значение половой
     * принадлежности пользователя:
     *
     * @return string
     */
    public function getGender()
    {
        $data = $this->getGendersList();

        return isset($data[$this->gender])
            ? $data[$this->gender]
            : $data[self::GENDER_THING];
    }

    /**
     * Получить url аватарки пользователя:
     * -----------------------------------
     * Возвращаем именно url, так как на
     * фронте может быть любая вариация
     * использования, незачем ограничивать
     * разработчиков.
     *
     * @param int $size - требуемый размер аватарки в пикселях
     *
     * @return string - url аватарки
     */
    public function getAvatar($size = 64)
    {
        $size = (int)$size;

        $userModule = Yii::app()->getModule('user');

        // если это граватар
        if ($this->use_gravatar && $this->email) {
            return 'http://gravatar.com/avatar/' . md5(trim($this->email)) . "?s=" . $size . "&d=" . urlencode(
                Yii::app()->createAbsoluteUrl('/') . $userModule->getDefaultAvatar()
            );
        }

        $avatar = $this->avatar;
        $path = $userModule->getUploadPath();

        if (!file_exists($path)) {
            $avatar = $userModule->defaultAvatar;
        }

        return Yii::app()->thumbnailer->thumbnail(
            $path . $avatar,
            $userModule->avatarsDir,
            $size,
            $size,
            \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND
        );
    }

    /**
     * Получаем полное имя пользователя:
     *
     * @param string $separator - разделитель
     *
     * @return string
     */
    public function getFullName($separator = ' ')
    {
        return ($this->first_name || $this->last_name)
            ? $this->first_name . $separator . $this->last_name
            : $this->nick_name;
    }

    /**
     * Удаление старого аватара:
     *
     * @return boolean
     */
    public function removeOldAvatar()
    {
        if (!$this->avatar) {
            return true;
        }

        $basePath = Yii::app()->getModule('user')->getUploadPath();

        if (file_exists($basePath . $this->avatar)) {
            @unlink($basePath . $this->avatar);
        }

        //remove old resized avatars
        foreach (glob($basePath . '/thumbs/' . '*' . $this->avatar) as $thumb) {
            @unlink($thumb);
        }

        $this->avatar = null;

        return true;
    }

    /**
     * Устанавливает новый аватар
     *
     * @param CUploadedFile $uploadedFile
     *
     * @throws CException
     *
     * @return boolean
     */
    public function changeAvatar(CUploadedFile $uploadedFile)
    {
        $basePath = Yii::app()->getModule('user')->getUploadPath();

        //создаем каталог для аватарок, если не существует
        if (!is_dir($basePath) && !@mkdir($basePath, 0755, true)) {
            throw new CException(Yii::t('UserModule.user', 'It is not possible to create directory for avatars!'));
        }

        $filename = $this->id . '_' . time() . '.' . $uploadedFile->extensionName;

        $this->removeOldAvatar();

        if (!$uploadedFile->saveAs($basePath . $filename)) {
            throw new CException(Yii::t('UserModule.user', 'It is not possible to save avatar!'));
        }

        $this->use_gravatar = false;

        $this->avatar = $filename;

        return true;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (int)$this->status === self::STATUS_ACTIVE;
    }
}
