<?php
/**
 * Отображение для update:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
    $this->breadcrumbs = array(
        Yii::app()->getModule('music')->getCategory() => array(),
        Yii::t('music', 'Genres') => array('/backend/music/genre/index'),
        $model->id => array('/backend/music/genre/view', 'id' => $model->id),
        Yii::t('music', 'Edit'),
    );

    $this->pageTitle = Yii::t('music', 'Genres - edit');

    $this->menu = array(
        array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('music', 'Manage genres'), 'url' => array('/backend/music/genre/index')),
        array('icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('music', 'Create genre'), 'url' => array('/backend/music/genre/create')),
        array('label' => Yii::t('music', 'Genre') . ' «' . mb_substr($model->id, 0, 32) . '»'),
        array('icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('music', 'Редактирование genre'), 'url' => array(
            '/backend/music/genre/update',
            'id' => $model->id
        )),
        array('icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('music', 'Просмотреть genre'), 'url' => array(
            '/backend/music/genre/view',
            'id' => $model->id
        )),
        array('icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('music', 'Удалить genre'), 'url' => '#', 'linkOptions' => array(
            'submit' => array('/backend/music/genre/delete', 'id' => $model->id),
            'confirm' => Yii::t('music', 'Вы уверены, что хотите удалить genre?'),
            'csrf' => true,
        )),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('music', 'Edit') . ' ' . Yii::t('music', 'genre'); ?>        <br/>
        <small>&laquo;<?php echo $model->id; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>