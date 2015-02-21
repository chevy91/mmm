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
 *   @var $model Track
 *   @var $form TbActiveForm
 *   @var $this TrackController
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'track-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions'            => array('class' => 'well', 'enctype' => 'multipart/form-data'),
    )
);
?>

<div class="alert alert-info">
    <?php echo Yii::t('music', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?php echo Yii::t('music', 'обязательны.'); ?>
</div>

<div class="row">
	
<div class="col-xs-7">
<?php echo $form->errorSummary($model); ?>
	<?php // echo $form->fileFieldGroup($model, 'file'); ?>
	<div class="form-group">
		<label class='control-label'>MP3 File</label>
		<div><?= $model->getMp3Url() ?></div>
	</div>
	
	<?php // echo $form->textFieldGroup($model, 'category_id', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('category_id'), 'data-content' => $model->getAttributeDescription('category_id'))))); ?>
	<?php echo $form->textFieldGroup($model, 'artist', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('artist'), 'data-content' => $model->getAttributeDescription('artist'))))); ?>

	<?php echo $form->textFieldGroup($model, 'title', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('title'), 'data-content' => $model->getAttributeDescription('title'))))); ?>


	<?php echo $form->textFieldGroup($model, 'BPM', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('BPM'), 'data-content' => $model->getAttributeDescription('BPM'))))); ?>


	<?php // echo $form->textAreaGroup($model, 'about', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'rows' => 6, 'cols' => 50, 'data-original-title' => $model->getAttributeLabel('about'), 'data-content' => $model->getAttributeDescription('about'))))); ?>


	<?php echo $form->textFieldGroup($model, 'year', array('widgetOptions' => array('htmlOptions' => array('class' => 'popover-help', 'data-original-title' => $model->getAttributeLabel('year'), 'data-content' => $model->getAttributeDescription('year'))))); ?>


    <?php
    $this->widget(
        'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('music', 'Сохранить track и продолжить'),
        )
    ); ?>
    <?php
    $this->widget(
        'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'htmlOptions'=> array('name' => 'submit-type', 'value' => 'index'),
            'label'      => Yii::t('music', 'Сохранить track и закрыть'),
        )
    ); ?>
</div>
<?php /*
<div class="col-xs-5">
	<label class="control-label">Genres</label>
	<div class="row">
	<?php foreach(Genre::model()->findAll() as $i => $genre) {
		$checkbox = CHtml::checkBox('Track[genresArray][' . $i . ']', in_array($genre->id, $model->genresArray), ['value' => $genre->id]);
		$label = CHtml::tag('label', ['class' => 'checkbox'], $checkbox . ' ' . $genre->name_en);
		echo CHtml::tag('div', ['class' => 'col-xs-4'], $label);
	} ?>
	</div>
</div>*/ ?>
</div>
<?php $this->endWidget(); ?>