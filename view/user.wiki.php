<p><?php echo $user->getName() ?> has <?php echo $user->kudos ?> Kudos</p>
<p><?php echo $user->getName() ?> has completed <?php echo $achievement_count ?> achievement(s) out of <?php echo $goal_count ?></p>

<?php if (count($user_professions) > 0): ?>
<h2>Professions</h2>
<?php foreach ($user_professions as $profession_key => $user_profession): ?>
<h3>[[Special:Professions#profession-<?php echo $profession_key ?>|<?php echo $user_profession->title ?>]]</h3>
Level <?php echo $user_profession->level ?> (<?php echo $user_profession->kudos ?> / <?php echo $user_profession->kudos_needed_for_next_level ?> Kudos)
<?php endforeach ?>
<?php endif ?>

<h2>Unlocked achievements</h2>
<AchievementList user="<?php echo $user->getName() ?>" />

<?php if (count($closest_achievements) > 0): ?>
<h2>Achievements in progress</h2>
<?php foreach ($closest_achievements as $goal): ?>
<Goal code="<?php echo $goal->code ?>" perspective="<?php echo $user->getName() ?>" />
<?php endforeach ?>
<?php endif ?>
