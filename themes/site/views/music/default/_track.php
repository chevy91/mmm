<div class="item">
	<h3><?= CHtml::link($data->title, ['/music/default/view', 'id' => $data->id]) ?></h3>
	<div class="item-details">
		<strong>Album</strong>: <?= $data->album ?><br />
		<strong>Genre</strong>: <?= $data->genre ?><br />
		<strong>BPM</strong>: <?= $data->BPM ?><br />
		<strong>Year</strong>: <?= $data->year ?>
	</div>
</div>