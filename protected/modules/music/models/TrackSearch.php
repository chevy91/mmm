<?php

class TrackSearch extends Track
{
	public $q;
	public $genres = [];
	public $genre;
	
	public $bpm_from;
	public $bpm_to;
	
	protected $_genreModels;
	protected $_genreModel;
	
	public function rules()
	{
		return [
			['q, genres, genre, bpm_from, bpm_to, year, title, artist, category_id', 'safe'],
		];
	}
	
	public function search()
	{
		$criteria = new CDbCriteria();
		
		$criteria->select = '*, (SELECT COUNT(id) FROM ' . Downloads::model()->tableName() . ' WHERE track_id = t.id) AS downloads_count';
		
		//$criteria->compare('category_id', $this->category_id);
		//$criteria->compare('BPM', $this->BPM);
		
		$criteria->compare('BPM', '>=' . $this->bpm_from);
		$criteria->compare('BPM', '<=' . $this->bpm_to);
		$criteria->compare('year', $this->year);
		
		$criteria->compare('title', $this->q, true);
		$criteria->compare('artist', $this->q, true, 'OR');
		$criteria->compare('album', $this->q, true, 'OR');
		
		if(!empty($this->genre)) {
			
			$criteria->addCondition('genre = :genre');
			$criteria->params['genre'] = $this->genre;
			
		}
		
		return new CActiveDataProvider($this, [
			'criteria' => $criteria,
			'sort' => [
				'attributes' => [
					'downloads_count' => [
						'asc' => 'downloads_count ASC',
						'desc' => 'downloads_count DESC',
					],
					'year',
				],
			],
		]);
	}
	
	public function getYearList()
	{
		$currYear = (int)date('Y');
		
		for($i = $currYear; $i >= ($currYear - 90); $i--) {
			$result[$i] = $i;
		}
		
		return $result;
	}
	
	public function getGenreModels()
	{
		if(isset($this->_genreModels)) {
			return $this->_genreModels;
		}
		
		return $this->_genreModels = Genre::model()->findAll();
	}
	
	public function getBreadcrumbs()
	{
		$breadcrumbs = [
			Yii::t('MusicModule.music', 'Record Pool'),
		];
		
		if(!empty($this->genreModel)) {
			$breadcrumbs = [
				Yii::t('MusicModule.music', 'Record Pool') => ['/music/default/index'],
				$this->genreModel->name_en,
			];
		}
		
		return $breadcrumbs;
	}
	
	protected function getGenreModel()
	{
		if(empty($this->genre)) {
			return null;
		}
		
		if(!empty($this->_genreModel)) {
			return $this->_genreModel;
		}
		
		return $this->_genreModel = Genre::model()->findByPk($this->genre, ['select' => 'name_en']);
	}
	
}
