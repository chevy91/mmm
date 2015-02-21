<?php
$this->pageTitle = Yii::t('UserModule.user', 'Sign up');
$this->breadcrumbs = [Yii::t('UserModule.user', 'Sign up')];
?>

<?php $this->widget('yupe\widgets\YFlashMessages'); ?>

<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id'          => 'registration-form',
        'type'        => 'vertical',
        'htmlOptions' => [
            'class' => 'well',
        ],
    ]
); ?>

<?php echo $form->errorSummary($model); ?>

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
        <?php echo $form->textFieldGroup($model, 'email', ['label' => Yii::t('UserModule.user', 'Your E-mail')]); ?>
    </div>
</div>

<div class='row'>
    <div class="col-xs-6">
        <?php echo $form->passwordFieldGroup($model, 'password', ['label' => Yii::t('UserModule.user', 'Create a personal password')]); ?>
    </div>
</div>

<div class='row'>
    <div class="col-xs-6">
        <?php echo $form->passwordFieldGroup($model, 'cPassword', ['label' => Yii::t('UserModule.user', 'Re-enter your password')]); ?>
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



<?php if ($module->showCaptcha && CCaptcha::checkRequirements()): { ?>
    <div class="row">
        <div class="col-xs-4">
            <?php echo $form->textFieldGroup(
                $model,
                'verifyCode',
                ['hint' => Yii::t('UserModule.user', 'Please enter the text from the image')]
            ); ?>
        </div>
        <div class="col-xs-4">
            <?php $this->widget(
                'CCaptcha',
                [
                    'showRefreshButton' => true,
                    'imageOptions'      => [
                        'width' => '150',
                    ],
                    'buttonOptions'     => [
                        'class' => 'btn btn-default',
                    ],
                    'buttonLabel'       => '<i class="glyphicon glyphicon-repeat"></i>',
                ]
            ); ?>
        </div>
    </div>
<?php } endif; ?>

<div class="row">
    <div class="col-xs-12">
        <?php
        $this->widget(
            'bootstrap.widgets.TbButton',
            [
                'buttonType' => 'submit',
                'context'    => 'primary',
                'label'      => Yii::t('UserModule.user', 'Sign up'),
            ]
        ); ?>
    </div>
</div>

<hr/>

<?php if (Yii::app()->hasModule('social')): { ?>
    <div class="row">
        <div class="col-xs-12">
            <?php
            $this->widget(
                'vendor.nodge.yii-eauth.EAuthWidget',
                [
                    'action'             => '/social/login',
                    'predefinedServices' => ['google', 'facebook', 'vkontakte', 'twitter', 'github'],
                ]
            );
            ?>
        </div>
    </div>
<?php } endif; ?>

<?php $this->endWidget(); ?>
<!-- form -->
