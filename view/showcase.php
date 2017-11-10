<div class="pleesher-showcase">
	<?php foreach ($goals as $showcased_goal): ?>
	<div class="pleesher-showcase-item pleesher-item-image_<?php echo str_replace(' ', '-', trim(preg_replace('/[^a-z0-9 ]/', '', strtolower($showcased_goal->title)))) ?>" title="<?php echo $showcased_goal->title ?>" data-toggle="popover-hover" data-placement="top" data-content="<?php echo $showcased_goal->short_description ?>">
		<div class="pleesher-showcase-item-icon"><?php if ($removable && !PleesherExtension::isDisabled()): ?>
		<a class="pleesher-showcase-item-icon-remove" data-redirect="self" href="<?php echo $h->actionUrl('pleesher.showcase_achievement', ['goal_id' => $showcased_goal->id, 'remove' => 1]) ?>"><i class="fa fa-times" aria-hidden="true"></i>
		</a><?php endif
	?></div>
	</div>
	<?php endforeach ?>
</div>