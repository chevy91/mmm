<?php
class DefaultController extends \yupe\components\controllers\FrontController
{
	public function actionIndex()
	{
		$model = new TrackSearch();
		
		if(isset($_GET)) {
			$model->setAttributes($_GET);
		}
		
		$dataProvider = $model->search();
		
		$this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $model,
		]);
	}
	
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		
		$this->render('view', ['model' => $model]);
	}
	
	public function actionDownload($id)
	{
		if(Yii::app()->user->isGuest) {
			$this->redirect(['/user/account/registration']);
		}
		
		$track = $this->loadModel($id);
		$user = Yii::app()->user->profile;
		
		if($user->canDownload()) {
			$downloadsCount = Downloads::model()->count(
				'track_id = :track AND user_id = :user', 
				[
					'user' => Yii::app()->user->id,
					'track' => $track->id,
				]
			);
			
			if($downloadsCount >= 2) {
				$this->render('downloadError', ['track' => $track]);
			} else {
				
				$download = new Downloads();
				$download->track_id = $track->id;
				$download->user_id = Yii::app()->user->getId();
				
				$download->save() or exit(CHtml::errorSummary($download));
				
				$path = $track->getMp3File();
				
				header('Content-Disposition: attachment; filename="' . $track->title . '.mp3"');
				readfile($path);
			}
			
		} else {
			$this->redirect(['/user/account/subscribe']);
		}
	}
	
	protected function loadModel($id)
	{
		$model = Track::model()->findByPk($id);
		
		if(!$model) {
			throw new CHttpException(404, 'The requested page doesn\'t exist!');
		}
		
		return $model;
	}
}
