<?php
/**
 * Класс TrackController:
 *
 *   @category YupeController
 *   @package  yupe
 *   @author   Yupe Team
 <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
require __DIR__ . '/../extensions/getid3/getid3.php';
require __DIR__ . '/../extensions/bpm-detect/class.bpm.php';
 
class TrackBackendController extends \yupe\components\controllers\BackController
{
    /**
     * Отображает track по указанному идентификатору
     *
     * @param integer $id Идинтификатор track для отображения
     *
     * @return void
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id)
        ));
    }
	
	public function actionAnalyze()
	{
		$dir = dirname(Yii::app()->basePath) . '/' . trim(Yii::app()->getModule('music')->analyzeDir, '/');
		$mp3Path = Yii::getPathOfAlias('webroot') . '/' . trim(Yii::app()->getModule('music')->uploadPath, '/');
		
		$files = Track::readFiles($dir);
		if(count($files) === 0) {
			die("There is no files to analyze! <a href='/backend/music/track'>Go back to dashboard</a>");
		}
		
		foreach($files as $file) {
			$md5 = md5($file);
			$first = substr($md5, 0, 1);
			$newPath = $first . '/' . $md5;
			
			$getid3 = new getID3();
			$getid3->encoding = 'UTF-8';
			$getid3->Analyze($dir . '/' . $file);
			
			if(!empty($getid3->info['tags']['id3v2'])) {
				$info = [
					'title' => $getid3->info['tags']['id3v2']['title'][0],
					'album' => $getid3->info['tags']['id3v2']['album'][0],
					'genre' => $getid3->info['tags']['id3v2']['genre'][0],
					'year' => $getid3->info['tags']['id3v2']['year'][0],
					'artist' => $getid3->info['tags']['id3v2']['artist'][0],
				];
			} elseif(!empty($getid3->info['tags']['id3v1'])) {
				$info = [
					'title' => $getid3->info['tags']['id3v1']['title'][0],
					'album' => $getid3->info['tags']['id3v1']['album'][0],
					'genre' => $getid3->info['tags']['id3v1']['genre'][0],
					'year' => $getid3->info['tags']['id3v1']['year'][0],
					'artist' => $getid3->info['tags']['id3v1']['artist'][0],
				];
			} elseif (!empty($getid3->info['id3v1']['title'])) {
				$info = $getid3->info['id3v1'];
			} elseif (!empty($getid3->info['id3v2']['title'])) {
				$info = $getid3->info['id3v2'];
			}
				
			$track = new Track();
			$track->album = $info['album'];
			$track->year = $info['year'];
			$track->genre = $info['genre'];
			$track->title = $info['title'];
			$track->artist = $info['artist'];
			$track->file = $newPath . '.mp3';
			
			$track->BPM = (new bpm_detect($dir . '/' . $file, false, true, getenv('PATH')))->detectBPM();
			
			
			if(!is_dir($newPath)) {
				mkdir(dirname($mp3Path . '/' . $track->file), 0777, true);
			}
			
			if(rename($dir. '/' . $file, $mp3Path . '/' . $track->file)) {
				$track->save() or die(CHtml::errorSummary($track));
			}
		}
		
		echo "New tracks has been added to database. <a href='/backend/music/track'>Go back to dashboard</a>";
	}
	
	public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if (isset($_POST['Track'])) {
            $model->attributes = $_POST['Track'];
            
            if ($model->save()) {
                Yii::app()->user->setFlash(yupe\widgets\YFlashMessages::SUCCESS_MESSAGE, Yii::t('music', 'Запись обновлена!'));
                
                if (!isset($_POST['submit-type']))
				$this->redirect(array(
				'update',
				'id' => $model->id
				));
                else
				$this->redirect(array(
				$_POST['submit-type']
				));
            }
        }
        $this->render('update', array(
		'model' => $model
        ));
    }
    
    
    /**
     * Удаляет модель track из базы.
     * Если удаление прошло успешно - возвращется в index
     *
     * @param integer $id идентификатор track, который нужно удалить
     *
     * @return void
     */
    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            // поддерживаем удаление только из POST-запроса
            $this->loadModel($id)->delete();
            
            Yii::app()->user->setFlash(yupe\widgets\YFlashMessages::SUCCESS_MESSAGE, Yii::t('music', 'Запись удалена!'));
            
            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
                    'index'
                ));
        } else
            throw new CHttpException(400, Yii::t('music', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }
    
    /**
     * Управление tracks.
     *
     * @return void
     */
    public function actionIndex()
    {
        $model = new Track('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Track']))
            $model->attributes = $_GET['Track'];
        $this->render('index', array(
            'model' => $model
        ));
    }
    
    /**
     * Возвращает модель по указанному идентификатору
     * Если модель не будет найдена - возникнет HTTP-исключение.
     *
     * @param integer идентификатор нужной модели
     *
     * @return void
     */
    public function loadModel($id)
    {
        $model = Track::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('music', 'Запрошенная страница не найдена.'));
        
        return $model;
    }
    
    /**
     * Производит AJAX-валидацию
     *
     * @param CModel модель, которую необходимо валидировать
     *
     * @return void
     */
    protected function performAjaxValidation(Track $model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'track-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}