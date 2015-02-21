<?php $this->pageTitle = Yii::t('UserModule.user', 'Subscribe Now'); ?>

<h1><?php echo Yii::t('UserModule.user', 'Subscribe Now'); ?></h1>

<?php $this->widget('yupe\widgets\YFlashMessages'); ?>

<div class="form">
    <?php $form = $this->beginWidget(
        'CActiveForm',
        [
            'id'                     => 'subscribe-form',
            'enableClientValidation' => true,
        ]
    ); ?>
	
	<?= $form->errorSummary($model) ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'subscribe_status'); ?>
        <?php echo $form->dropDownList($model, 'subscribe_status', $model->getSubscribeList(), ['class' => 'form-control']); ?>
        <?php echo $form->error($model, 'subscribe_status'); ?>
    </div>

    <div class="submit">
        <?php echo CHtml::submitButton(Yii::t('UserModule.user', 'Submit')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
