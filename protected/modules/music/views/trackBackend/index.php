<?php
/**
 * Отображение для index:
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
        Yii::t('music', 'Management'),
    );

    $this->pageTitle = Yii::t('music', 'Tracks - management');

    $this->menu = array(
        array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('music', 'Manage tracks'), 'url' => array('/backend/music/track/index')),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('music', 'Tracks'); ?>
        <small><?php echo Yii::t('music', 'management'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?php echo Yii::t('music', 'Find tracks');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
    <?php
Yii::app()->clientScript->registerScript('search', "
    $('.search-form form').submit(function () {
        $.fn.yiiGridView.update('track-grid', {
            data: $(this).serialize()
        });

        return false;
    });
");
$this->renderPartial('_search', array('model' => $model));
?>
</div>

<br/>


<?php
 $this->widget('yupe\widgets\CustomGridView', array(
'id'           => 'track-grid',
'type'         => 'striped condensed',
'dataProvider' => $model->search(),
'filter'       => $model,
'columns'      => array(
        'id',
        'artist',
		'album',
        'title',
        'BPM',
		[
			'name' => 'file',
			'value' => function($data) {
				return $data->getMp3Url();
			},
		],
        /*
        'year',
        'created_at',
        'updated_at',
        */
array(
'class' => 'yupe\widgets\CustomButtonColumn',
),
),
)); ?>
