<?php

/**
 * This is the model class for table "{{music_track}}".
 *
 * The followings are the available columns in table '{{music_track}}':
 * @property integer $id
 * @property integer $category_id
 * @property string $artist
 * @property string $title
 * @property integer $BPM
 * @property string $about
 * @property integer $year
 * @property integer $created_at
 * @property integer $updated_at
 */
class Track extends yupe\models\YModel
{
	protected $_genresArray = [];
	public $downloads_count;
	
	public function getGenreList()
	{
		$result = Genre::model()->findAll(['select' => 'name_en']);
		//return $result;
		
		return CHtml::listData($result, 'name_en', 'name_en');
	}
	
	public function beforeDelete()
	{
		$file = $this->getMp3File();
		$dir = dirname( $file );
		
		@unlink($file);
		
		if(static::readFiles($dir) === []) {
			rmdir($dir);
		}
		
		return true;
	}
	
	public static function readFiles($dir)
	{
		if(!is_dir($dir)) {
			return false;
		}
		
		$dirHandle = opendir($dir);
		$result = [];
		
		while (false !== ($file = readdir($dirHandle))) {
			if ($file == '.' || $file == '..') {
				continue;
			}
			
			$result[] = $file;
		}
		
		return $result;
	}
	
	public function getMp3Url()
	{
		return '/' . trim(Yii::app()->getModule('music')->uploadPath, '/') . '/' . $this->file;
	}
	
	public function getMp3File()
	{
		return Yii::getPathOfAlias('webroot') . '/' . trim($this->getMp3Url(), '/');
	}
	
	public function setGenresArray($array) 
	{
		$this->_genresArray = $array;
	}
	
	public function getGenresArray()
	{
		if(!empty($this->_genresArray)) {
			return $this->_genresArray;
		} elseif($genres = $this->genres) {
			return array_map(function($data) { return $data->id; }, $genres);
		} else {
			return [];
		}
	}
	
	public function behaviors()
	{
		return [
			'timestampBehavior' => [
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'created_at',
				'updateAttribute' => 'updated_at',
			],
			/*
			'fileUploadBehavior' => [
				'class' => 'yupe\components\behaviors\FileUploadBehavior',
				'attributeName' => 'file',
				'types' => 'mp3',
				'requiredOn' => ['insert'],
				'scenarios' => ['insert', 'update'],
				'uploadPath' => Yii::app()->getModule('music')->uploadPath,
				'fileName' => [$this, 'generateFileName'],
			], */
		];
	}
	
	public function generateFileName()
	{
		return $this->file;
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{music_track}}';
	}
	/*
	public function afterSave()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'track_id = :id';
		$criteria->params = ['id' => $this->id];
		
		GenreTag::model()->deleteAll($criteria);
		foreach($this->genresArray as $id) {
			$genre = new GenreTag();
			$genre->track_id = $this->id;
			$genre->genre_id = $id;
			$genre->save();
		}
		
		return parent::afterSave();
	}
	*/
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('artist, title', 'required'),
			['title', 'unique'],
			//['year, BPM', 'numerical', 'integerOnly' => true, 'allowEmpty' => true],
			array('category_id, BPM, about, year', 'safe'),
			array('artist, title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category_id, artist, title, BPM, about, year, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'genres' => [self::MANY_MANY, 'Genre', '{{music_genre_tag}}(track_id, genre_id)'],
			'tags'   => [self::HAS_MANY, 'GenreTag', ['track_id' => 'id']],
			'downloadsCount'   => [self::STAT, 'Downloads', 'track_id'],
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'artist' => 'Artist',
			'title' => 'Title',
			'BPM' => 'Bpm',
			'about' => 'About',
			'year' => 'Year',
			'downloads_count' => 'Downloads',
			'downloadsCount' => 'Downloads',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('artist',$this->artist,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('BPM',$this->BPM);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('updated_at',$this->updated_at);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MusicTrack the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
}
