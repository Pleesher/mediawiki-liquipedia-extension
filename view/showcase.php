<div class="pleesher-showcase">
	<?php foreach ($goals as $showcased_goal): ?>
	<div class="pleesher-showcase-item" title="<?php echo $showcased_goal->title ?>" data-toggle="popover-hover" data-placement="top" data-content="<?php echo $showcased_goal->short_description ?>">
		<div class="pleesher-showcase-item-icon"><?php if ($removable): ?>
		[ <a data-redirect="self" href="<?php echo $h->actionUrl('pleesher.showcase_achievement', ['goal_id' => $showcased_goal->id, 'remove' => 1]) ?>">X</a> ]
		<?php endif ?></div>
	</div>
	<?php endforeach ?>
</div>