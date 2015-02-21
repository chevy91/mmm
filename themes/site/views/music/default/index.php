<?php 
	$this->pageTitle = "Record Pool";
	$this->breadcrumbs = $searchModel->getBreadcrumbs();
	
?>

<h1>Search Music</h1>

<div class="row">
	<div class="col-xs-9">
	
		<?php $this->widget('bootstrap.widgets.TbListView', [
			'dataProvider' => $dataProvider,
			'itemView' => '_track',
			'template' => "{sorter}\n{items}\n{pager}",
			'sortableAttributes' => ['year', 'downloads_count'],
		]); ?>
	
	</div>
	
	<div class="col-xs-3">
		<div class="panel panel-default">
			<div class="panel-heading"><?= Yii::t('MusicModule.music', 'Search Filters') ?></div>
			<div class="panel-body">
				<?= CHtml::beginForm([''], 'GET') ?>
				
					<div class="form-group">
						<label class="control-label">Search query</label>
						<?= CHtml::textField('q', $searchModel->q, ['class' => 'form-control']) ?>
					</div>
					
					<div class="form-group">
						<label class="control-label">Genre</label>
						<?= CHtml::dropDownList('genre', $searchModel->genre, $searchModel->getGenreList(), ['empty' => 'All', 'class' => 'form-control']) ?>
					</div>
					
					
					<div class="form-group">
						<label class="control-label">BPM</label>
						<div class="row">
							<div class="col-md-6"><?= CHtml::textField('bpm_from', $searchModel->bpm_from, ['class' => 'form-control', 'placeholder' => 'From']) ?></div>
							<div class="col-md-6"><?= CHtml::textField('bpm_to', $searchModel->bpm_to, ['class' => 'form-control', 'placeholder' => 'To']) ?></div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label">Year</label>
						<?= CHtml::dropDownList('year', $searchModel->year, $searchModel->getYearList(), ['class' => 'form-control', 'empty' => 'Choose...']) ?>
					</div>
					
					<div class="buttons">
						<button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
					</div>
				
				<?= CHtml::endForm() ?>
			</div>
		</div>
	</div>

</div>