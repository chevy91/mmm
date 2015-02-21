<?php
/**
 * Отображение для create:
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
        Yii::t('music', 'Creating'),
    );

    $this->pageTitle = Yii::t('music', 'Tracks - creating');

    $this->menu = array(
        array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('music', 'Manage tracks'), 'url' => array('/backend/music/track/index')),
        array('icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('music', 'Add track'), 'url' => array('/backend/music/track/create')),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('music', 'Tracks'); ?>
        <small><?php echo Yii::t('music', 'creating'); ?></small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>