<?php echo $user->getName() ?> has <?php echo $user->kudos ?> Kudos !
<?php if (count($user_professions) > 0): ?>
<h2>Professions</h2>
<?php foreach ($user_professions as $profession_key => $user_profession): ?>
<h3>[[Special:Professions#profession-<?php echo $profession_key ?>|<?php echo $user_profession->title ?>]]</h3>
Level <?php echo $user_profession->level ?> (<?php echo $user_profession->kudos ?> Kudos)
<?php endforeach ?>
<?php endif ?>

<h2>Unlocked achievements</h2>
<AchievementList user="<?php echo $user->getName() ?>" />

<h2>Closest Achievements</h2>
<?php foreach (PleesherExtension::getClosestAchievements($user->getId(), 3) as $goal): ?>
<Goal code="<?php echo $goal->code ?>" perspective="<?php echo $user->getName() ?>" />
<br>
<?php endforeach ?>
