<?php 
	$this->pageTitle = $model->title;
	$this->breadcrumbs = ['Record Pool' => ['index']];
	$this->breadcrumbs[] = $model->title;
?>

<h1><?= $model->title ?></h1>

<div class="description">
	<?= $model->about ?>
</div>

<div class="detail">
	<?php $this->widget('bootstrap.widgets.TbDetailView', [
		'data' => $model,
		'attributes' => [
			'title',
			'genre',
			'BPM',
			'artist',
			'album',
			'downloadsCount',
			[
				'label' => 'Download link',
				'type' => 'html',
				'value' => function($data) {
					return CHtml::link('<i class="fa fa-upload"></i> Download', ['/music/default/download', 'id' => $data->id], ['target' => '_blank', 'class' => 'btn btn-sm btn-default']);
				}
			],
		],
	]); ?>
</div>