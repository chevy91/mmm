<?php
/**
 * Отображение для _form:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 *
 *   @var $model Genre
 *   @var $form TbActiveForm
 *   @var $this GenreController
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'genre-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions'            => array('class' => 'well'),
    )
);
?>


<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-sm-7">
            <?php echo $form->textFieldGroup($model, 'name_en', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('name_en'), 'data-content' => $model->getAttributeDescription('name_en'))))); ?>
        </div>
    </div>

    <?php
    $this->widget(
        'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('music', 'Save genre and continue'),
        )
    ); ?>
    <?php
    $this->widget(
        'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'htmlOptions'=> array('name' => 'submit-type', 'value' => 'index'),
            'label'      => Yii::t('music', 'Save genre and close'),
        )
    ); ?>

<?php $this->endWidget(); ?>