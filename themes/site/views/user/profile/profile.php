<?php
$this->pageTitle = Yii::t('UserModule.user', 'User profile');
$this->breadcrumbs = [Yii::t('UserModule.user', 'User profile')];

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id'                     => 'profile-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'type'                   => 'vertical',
        'htmlOptions'            => [
            'class'   => 'well',
            'enctype' => 'multipart/form-data',
        ]
    ]
);
?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-6">
        <?php echo $form->textFieldGroup(
            $user,
            'email',
            [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'disabled' => true,
                        'class'    => Yii::app()->user->profile->getIsVerifyEmail() ? 'text-success' : ''
                    ],
                ],
                'append'        => CHtml::link(Yii::t('UserModule.user', 'Change email'), ['/user/profile/email']),
            ]
        ); ?>
        <?php if (Yii::app()->user->profile->getIsVerifyEmail()): { ?>
            <p class="email-status-confirmed text-success">
                <?php echo Yii::t('UserModule.user', 'E-mail was verified'); ?>
            </p>
        <?php } else: { ?>
            <p class="email-status-not-confirmed text-error">
                <?php echo Yii::t('UserModule.user', 'e-mail was not confirmed, please check you mail!'); ?>
            </p>
        <?php } endif ?>
    </div>
</div>

<div class='row'>
    <div class="col-xs-6">
        <?php echo $form->textFieldGroup($model, 'dj_name'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-xs-3">
        <?php echo $form->textFieldGroup($model, 'first_name', ['label' => Yii::t('UserModule.user', 'Your First Name')]); ?>
    </div>
	
	<div class="col-xs-3">
        <?php echo $form->textFieldGroup($model, 'last_name', ['label' => Yii::t('UserModule.user', 'Your Last Name')]); ?>
    </div>
</div>

<div class='row'>
    <div class="col-xs-6">
        <?php echo $form->textFieldGroup($model, 'phone'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-xs-6">
        <?php echo $form->textFieldGroup($model, 'address'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-xs-6">
        <?php echo $form->textFieldGroup($model, 'country'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-xs-6">
        <?php echo $form->textFieldGroup($model, 'zip'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-xs-6">
		<div class="form-group">
			<?= $form->label($model, 'club_residencies') ?>
			<?php echo $form->textArea($model, 'club_residencies', ['class' => 'form-control']); ?>
			<?= $form->error($model, 'clubs_residencies') ?>
		</div>
    </div>
</div>

<div class='row'>
    <div class="col-xs-6">
		<div class="form-group">
			<?= $form->label($model, 'radios_residencies') ?>
			<?php echo $form->textArea($model, 'radios_residencies', ['class' => 'form-control']); ?>
			<?= $form->error($model, 'radios_residencies') ?>
		</div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php if (is_array($this->module->profiles) && count($this->module->profiles)): { ?>
            <?php foreach ($this->module->profiles as $k => $p): { ?>
                <?php $this->renderPartial("//" . $k . "/" . $k . "_profile", ["model" => $p, "form" => $form]); ?>
            <?php } endforeach; ?>
        <?php } endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            [
                'buttonType' => 'submit',
                'context'    => 'primary',
                'label'      => Yii::t('UserModule.user', 'Save profile'),
            ]
        ); ?>
        <?php echo CHtml::link(Yii::t('UserModule.user', 'Change password'), ['/user/profile/password'], ['class' => 'btn btn-default']); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
