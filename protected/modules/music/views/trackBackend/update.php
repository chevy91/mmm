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
        Yii::t('music', 'Tracks') => array('/music/track/index'),
        $model->title => array('/music/track/view', 'id' => $model->id),
        Yii::t('music', 'Edit'),
    );

    $this->pageTitle = Yii::t('music', 'Tracks - edit');

    $this->menu = array(
        array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('music', 'Manage tracks'), 'url' => array('/backend/music/track/index')),
        array('label' => Yii::t('music', 'Track') . ' «' . mb_substr($model->id, 0, 32) . '»'),
        array('icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('music', 'Update track'), 'url' => array(
            '/backend/music/track/update',
            'id' => $model->id
        )),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('music', 'Edit') . ' ' . Yii::t('music', 'track'); ?>        <br/>
        <small>&laquo;<?php echo $model->title; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>