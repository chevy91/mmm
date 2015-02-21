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
        Yii::t('music', 'Genres') => array('/backend/music/genre/index'),
        Yii::t('music', 'Manage genres'),
    );

    $this->pageTitle = Yii::t('music', 'Manage genres');

    $this->menu = array(
        array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('music', 'Manage genres'), 'url' => array('/backend/music/genre/index')),
        array('icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('music', 'Create genre'), 'url' => array('/backend/music/genre/create')),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('music', 'Genres'); ?>
        <small><?php echo Yii::t('music', 'manage'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?php echo Yii::t('music', 'Search genres');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
    <?php
Yii::app()->clientScript->registerScript('search', "
    $('.search-form form').submit(function () {
        $.fn.yiiGridView.update('genre-grid', {
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
'id'           => 'genre-grid',
'type'         => 'striped condensed',
'dataProvider' => $model->search(),
'filter'       => $model,
'columns'      => array(
        'id',
        'name_en',
		[
			'name' => 'created_at',
			'value' => function($data) {
				return date('Y-m-d, H:i', $data->created_at);
			}
		],
		
		[
			'name' => 'updated_at',
			'value' => function($data) {
				if(!empty($data->updated_at)) {
					return date('Y-m-d, H:i', $data->updated_at);
				}
			}
		],
array(
'class' => 'yupe\widgets\CustomButtonColumn',
),
),
)); ?>
