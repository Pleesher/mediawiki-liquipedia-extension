<div class="pleesher-liquigoals-title">Achievements</div>
<div class="pleesher-liquigoals">
	<div class="pleesher-kudos"><!--
		--><div class="pleesher-kudos-big"><!--
			--><?php echo $user->kudos ?><!--
		--></div><!--
		--><div class="pleesher-kudos-small"><!--
			-->Total Kudos<!--
		--></div><!--
	--></div>
	<div class="pleesher-progress"><!--
		--><div class="pleesher-progress-inner" style="width:<?php echo (min($achievement_count, $goal_count) / $goal_count * 100); ?>%;"></div><!--
		--><span class="pleesher-progress-text-fixed-left">Achievements Completed</span><!--
		--><span class="pleesher-progress-text-fixed-right"><?php echo min($achievement_count, $goal_count) . '/' . $goal_count; ?></span><!--
	--></div><!--
	<div class="pleesher-liquigoals-title">Achievement Showcase</div>-->
	<?php if (count($user_professions) > 0): ?>
		<div class="pleesher-liquigoals-title">Professions</div>
		<div class="pleesher-professions">
			<?php foreach ($user_professions as $profession_key => $user_profession): ?>
				<div class="pleesher-profession">
					<div class="pleesher-progress"><!--
						--><div class="pleesher-progress-inner" style="width:<?php echo (min($user_profession->kudos, $user_profession->kudos_needed_for_next_level) / $user_profession->kudos_needed_for_next_level * 100); ?>%;"></div><!--
						--><span class="pleesher-progress-text-fixed-left">[[Special:Professions#profession-<?php echo $profession_key ?>|<?php echo $user_profession->title ?>]] Lv <?php echo $user_profession->level ?></span><!--
						--><span class="pleesher-progress-text-fixed-right"><?php echo $user_profession->kudos . '/' . $user_profession->kudos_needed_for_next_level ?> Kudos</span><!--
							
					--></div>
				</div>
			<?php endforeach ?>
		</div>
	<?php endif ?>
	<div class="pleesher-liquigoals-title">Completed Achievements</div>
	<AchievementList user="<?php echo $user->getName() ?>" />

	<?php if (count($closest_achievements) > 0): ?>
		<div class="pleesher-liquigoals-title">Achievements In Progress</div>
		<?php foreach ($closest_achievements as $goal): ?>
			<Goal code="<?php echo $goal->code ?>" perspective="<?php echo $user->getName() ?>" />
		<?php endforeach ?>
	<?php endif ?>
</div>