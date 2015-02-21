<?php
/**
 * Отображение для _search:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'action'      => Yii::app()->createUrl($this->route),
        'method'      => 'get',
        'type'        => 'vertical',
        'htmlOptions' => array('class' => 'well'),
    )
);
?>

<fieldset>
    <div class="row">
                    <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'id', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('id'), 'data-content' => $model->getAttributeDescription('id'))))); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'category_id', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('category_id'), 'data-content' => $model->getAttributeDescription('category_id'))))); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'artist', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('artist'), 'data-content' => $model->getAttributeDescription('artist'))))); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'title', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('title'), 'data-content' => $model->getAttributeDescription('title'))))); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'BPM', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('BPM'), 'data-content' => $model->getAttributeDescription('BPM'))))); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textAreaGroup($model, 'about', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'rows' => 6, 'cols' => 50, 'data-original-title' => $model->getAttributeLabel('about'), 'data-content' => $model->getAttributeDescription('about'))))); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'year', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('year'), 'data-content' => $model->getAttributeDescription('year'))))); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'created_at', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('created_at'), 'data-content' => $model->getAttributeDescription('created_at'))))); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'updated_at', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('updated_at'), 'data-content' => $model->getAttributeDescription('updated_at'))))); ?>
            </div>
    </div>
</fieldset>

    <?php
    $this->widget(
        'bootstrap.widgets.TbButton', array(
            'context'     => 'primary',
            'encodeLabel' => false,
            'buttonType'  => 'submit',
            'label'       => '<i class="fa fa-search">&nbsp;</i> ' . Yii::t('music', 'Искать track'),
        )
    ); ?>

<?php $this->endWidget(); ?>