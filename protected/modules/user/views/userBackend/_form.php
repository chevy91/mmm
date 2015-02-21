<?php
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id'                     => 'user-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'type'                   => 'vertical',
        'htmlOptions'            => ['class' => 'well'],
    ]
); ?>

<div class="alert alert-info">
    <?php echo Yii::t('UserModule.user', 'Fields with'); ?>
    <span class="required">*</span>
    <?php echo Yii::t('UserModule.user', 'are required'); ?>
</div>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup(
            $model,
            'nick_name'
        ); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'email'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'last_name'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'first_name'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'phone'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'address'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'country'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup($model, 'zip'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
		<div class="form-group">
			<?= $form->label($model, 'club_residencies') ?>
			<?php echo $form->textArea($model, 'club_residencies', ['class' => 'form-control']); ?>
			<?= $form->error($model, 'club_residencies') ?>
		</div>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
		<div class="form-group">
			<?= $form->label($model, 'radios_residencies') ?>
			<?php echo $form->textArea($model, 'radios_residencies', ['class' => 'form-control']); ?>
			<?= $form->error($model, 'radios_residencies') ?>
		</div>
    </div>
</div>


<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'status',
            [
                'widgetOptions' => [
                    'data' => $model->getStatusList(),
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'subscribe_status',
            [
                'widgetOptions' => [
                    'data' => $model->getSubscribeList(),
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'email_confirm',
            [
                'widgetOptions' => [
                    'data' => $model->getEmailConfirmStatusList(),
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'access_level',
            [
                'widgetOptions' => [
                    'data' => $model->getAccessLevelsList(),
                ],
            ]
        ); ?>
    </div>
</div>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context'    => 'primary',
        'label'      => $model->isNewRecord ? Yii::t('UserModule.user', 'Create user and continue') : Yii::t(
            'UserModule.user',
            'Save user and continue'
        ),
    ]
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType'  => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label'       => $model->isNewRecord ? Yii::t('UserModule.user', 'Create user and close') : Yii::t(
            'UserModule.user',
            'Save user and close'
        ),
    ]
); ?>

<?php $this->endWidget(); ?>
