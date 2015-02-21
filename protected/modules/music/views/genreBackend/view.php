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
        Yii::t('music', 'Genres') => array('/music/genre/index'),
        $model->id,
    );

    $this->pageTitle = Yii::t('music', 'Genres - просмотр');

    $this->menu = array(
        array('icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('music', 'Управление genres'), 'url' => array('/music/genre/index')),
        array('icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('music', 'Добавить genre'), 'url' => array('/music/genre/create')),
        array('label' => Yii::t('music', 'Genre') . ' «' . mb_substr($model->id, 0, 32) . '»'),
        array('icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('music', 'Редактирование genre'), 'url' => array(
            '/music/genre/update',
            'id' => $model->id
        )),
        array('icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('music', 'Просмотреть genre'), 'url' => array(
            '/music/genre/view',
            'id' => $model->id
        )),
        array('icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('music', 'Удалить genre'), 'url' => '#', 'linkOptions' => array(
            'submit' => array('/music/genre/delete', 'id' => $model->id),
            'confirm' => Yii::t('music', 'Вы уверены, что хотите удалить genre?'),
            'csrf' => true,
        )),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('music', 'Просмотр') . ' ' . Yii::t('music', 'genre'); ?>        <br/>
        <small>&laquo;<?php echo $model->id; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
'data'       => $model,
'attributes' => array(
        'id',
        'name_en',
        'order',
        'created_at',
        'updated_at',
),
)); ?>
