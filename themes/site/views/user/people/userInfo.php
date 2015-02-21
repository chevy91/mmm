<?php
$this->pageTitle = CHtml::encode($user->nick_name);
$this->breadcrumbs = [
    Yii::t('UserModule.user', 'Users') => ['/user/people/index/'],
    CHtml::encode($user->getfullName()),
];
?>

<div class="row">
    <div class='col-xs-6'>
        <i class="glyphicon glyphicon-user"></i> <?php echo CHtml::link(CHtml::encode($user->getFullName()), ['/user/people/userInfo/', 'username' => CHtml::encode($user->nick_name)]); ?>
        <br/>
        <?php if ($user->last_visit): { ?>
            <i class="glyphicon glyphicon-time"></i> <?php echo Yii::t(
                'UserModule.user',
                'Last visit {last_visit}',
                [
                    "{last_visit}" => Yii::app()->dateFormatter->formatDateTime($user->last_visit, 'long', null)
                ]
            );?><br/>
        <?php } endif; ?>
    </div>
</div>
