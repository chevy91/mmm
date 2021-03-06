<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $data->id ?>">
                <?php echo yupe\helpers\YText::characterLimiter(strip_tags($data->theme), 250); ?>
            </a>
        </h4>
    </div>
    <div id="collapse-<?php echo $data->id ?>" class="panel-collapse collapse">
        <div class="panel-body">
            <?php echo strip_tags($data->answer); ?>
            <span class="label label-info">
                <?php echo CHtml::link(
                    Yii::t('FeedbackModule.feedback', 'More...'),
                    ['/feedback/contact/faqView', 'id' => $data->id]
                ); ?>
            </span>
        </div>
    </div>
</div>
