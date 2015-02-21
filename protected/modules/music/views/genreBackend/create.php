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
        Yii::t('music', 'Genres') => array('/backend/music/genre/index'),
        Yii::t('music', 'Create'),
    );

    $this->pageTitle = Yii::t('music', 'Genres - create');

    $this->menu = array(
        array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('music', 'Manage genres'), 'url' => array('/backend/music/genre/index')),
        array('icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('music', 'Create genre'), 'url' => array('/backend/music/genre/create')),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('music', 'Genres'); ?>
        <small><?php echo Yii::t('music', 'create'); ?></small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>