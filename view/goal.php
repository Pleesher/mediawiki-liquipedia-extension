<?php if (!isset($actions)) $actions = [] ?>

<article id="goal-<?php echo $goal->code ?>" class="pleesher-goal <?php echo ((!empty($goal->achieved)) ? 'pleesher-goal-earned' : 'pleesher-goal-unearned') ?>">
	<div class="pleesher-table">
		<div class="pleesher-row">
			<div class="pleesher-cell pleesher-cell-logo">
				<div class="pleesher-liquipedia-logo pleesher-item-image-<?php echo $goal->id; ?> wiki-backgroundcolor-dark"></div>
			</div>
			<div class="pleesher-cell pleesher-cell-main">
				<div class="pleesher-achievement"><!--
					--><div class="pleesher-achievement-title"><!--
						--><a href="<?php echo $h->pageUrl('Special:AchievementDetails/' . $goal->code) ?>"><?php echo htmlspecialchars($goal->title) ?></a><!--
						--><?php if (!empty($goal->achieved)): ?><!--
							--><div class="pleesher-checkmark"></div><!--
						--><?php endif ?><!--
					--></div><!--
					--><div class="pleesher-achievement-description"><!--
						--><?php echo htmlspecialchars($goal->short_description) ?><!--
					--></div><!--
					--><?php if (isset($goal->progress)): ?><!--
						--><div class="pleesher-achievement-progress"><!--
							--><div class="pleesher-progress"><!--
								--><div class="pleesher-progress-inner" style="width:<?php echo (min($goal->progress->current, $goal->progress->target) / $goal->progress->target * 100); ?>%;"></div><!--
							--></div><!--
							--><div class="pleesher-progress-text"><?php echo min($goal->progress->current, $goal->progress->target) ?>/<?php echo $goal->progress->target ?></div><!--
						--></div><!--
					--><?php endif ?><!--
					--><?php if (!empty($goal->achieved)): ?><!--
						--><div class="pleesher-achievement-date"><!--
							--><?php
								$tz = new DateTimeZone($goal->participation->datetime->timezone);
								$t = new DateTime($goal->participation->datetime->date, $tz);
								echo 'Achieved ' . date('M j, Y', $t->getTimestamp()) ?><!--
						--></div><!--
					--><?php endif ?><!--
					--><?php if (isset($user) && !empty($goal->achieved) && in_array('revoke', $actions) && !PleesherExtension::isDisabled()): ?><!--
						--><div class="pleesher-achievement-revoke"><!--
							--><a data-redirect="self" href="<?php echo $h->actionUrl('pleesher.revoke_achievement', ['user_name' => $user->getName(), 'goal_id' => $goal->id, 'duration' => 'forever']) ?>"
								data-confirm="<?php echo $h->text('pleesher.revoke_achievement.confirm') ?>"
								>Revoke</a><!--
						--></div><!--
					--><?php endif ?><!--
					--><?php if (empty($goal->showcased) && in_array('showcase', $actions) && !PleesherExtension::isDisabled()): ?><!--
						--><div class="pleesher-achievement-revoke"><!--
							--><a data-redirect="self" href="<?php echo $h->actionUrl('pleesher.showcase_achievement', ['goal_id' => $goal->id]) ?>">Showcase</a><!--
						--></div><!--
					--><?php endif ?><!--
				--></div>
			</div>
			<div class="pleesher-cell pleesher-cell-kudos">
				<div class="pleesher-kudos"><!--
					--><div class="pleesher-kudos-big"><!--
						--><?php echo $goal->kudos ?><!--
					--></div><!--
					--><div class="pleesher-kudos-small"><!--
						-->Kudos<!--
					--></div><!--
				--></div>
			</div>
		</div>
	</div>
</article>