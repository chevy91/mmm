<?php
/**
* Класс GenreController:
*
*   @category YupeController
*   @package  yupe
*   @author   Yupe Team
<team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     http://yupe.ru
**/
class GenreBackendController extends \yupe\components\controllers\BackController
{
/**
* Отображает genre по указанному идентификатору
*
* @param integer $id Идинтификатор genre для отображения
*
* @return void
*/
public function actionView($id)
{
$this->render('view', array('model' => $this->loadModel($id)));
}

/**
* Создает новую модель genre.
* Если создание прошло успешно - перенаправляет на просмотр.
*
* @return void
*/
public function actionCreate()
{
$model = new Genre;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if (isset($_POST['Genre'])) {
$model->attributes = $_POST['Genre'];

if ($model->save()) {
Yii::app()->user->setFlash(
yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
Yii::t('music', 'Created!')
);

if (!isset($_POST['submit-type']))
$this->redirect(array('update', 'id' => $model->id));
else
$this->redirect(array($_POST['submit-type']));
}
}
$this->render('create', array('model' => $model));
}

/**
* Редактирование genre.
*
* @param integer $id Идинтификатор genre для редактирования
*
* @return void
*/
public function actionUpdate($id)
{
$model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if (isset($_POST['Genre'])) {
$model->attributes = $_POST['Genre'];

if ($model->save()) {
Yii::app()->user->setFlash(
yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
Yii::t('music', 'Updated!')
);

if (!isset($_POST['submit-type']))
$this->redirect(array('update', 'id' => $model->id));
else
$this->redirect(array($_POST['submit-type']));
}
}
$this->render('update', array('model' => $model));
}

/**
* Удаляет модель genre из базы.
* Если удаление прошло успешно - возвращется в index
*
* @param integer $id идентификатор genre, который нужно удалить
*
* @return void
*/
public function actionDelete($id)
{
if (Yii::app()->getRequest()->getIsPostRequest()) {
// поддерживаем удаление только из POST-запроса
$this->loadModel($id)->delete();

Yii::app()->user->setFlash(
yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
Yii::t('music', 'Deleted!')
);

// если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
if (!isset($_GET['ajax']))
$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
} else
throw new CHttpException(400, Yii::t('music', 'Wrong request.'));
}

/**
* Управление genres.
*
* @return void
*/
public function actionIndex()
{
$model = new Genre('search');
$model->unsetAttributes(); // clear any default values
if (isset($_GET['Genre']))
$model->attributes = $_GET['Genre'];
$this->render('index', array('model' => $model));
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
$model = Genre::model()->findByPk($id);
if ($model === null)
throw new CHttpException(404, Yii::t('music', 'The requested page doesn\'t exist.'));

return $model;
}

/**
* Производит AJAX-валидацию
*
* @param CModel модель, которую необходимо валидировать
*
* @return void
*/
protected function performAjaxValidation(Genre $model)
{
if (isset($_POST['ajax']) && $_POST['ajax'] === 'genre-form') {
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
