<?php
/**
 * Отображение для view:
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
        $model->title,
    );

    $this->pageTitle = Yii::t('music', 'Tracks - просмотр');

    $this->menu = array(
        array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('music', 'Управление tracks'), 'url' => array('/backend/music/track/index')),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('music', 'Просмотр') . ' ' . Yii::t('music', 'track'); ?>        <br/>
        <small>&laquo;<?php echo $model->title; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
'data'       => $model,
'attributes' => array(
        'id',
        'category_id',
        'artist',
        'title',
        'BPM',
        'about',
        'year',
        'created_at',
        'updated_at',
),
)); ?>
