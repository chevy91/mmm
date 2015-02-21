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
                <?php echo $form->textFieldGroup($model, 'name_en', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('name_en'), 'data-content' => $model->getAttributeDescription('name_en'))))); ?>
            </div>
            <div class="col-sm-3">
                <?php echo $form->textFieldGroup($model, 'order', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('order'), 'data-content' => $model->getAttributeDescription('order'))))); ?>
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
            'label'       => '<i class="fa fa-search">&nbsp;</i> ' . Yii::t('music', 'Искать genre'),
        )
    ); ?>

<?php $this->endWidget(); ?>