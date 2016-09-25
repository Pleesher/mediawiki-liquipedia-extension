<?php echo $username ?> has <UserKudos user="<?php echo $username ?>" /> Kudos !
<?php if (count($user_professions) > 0): ?>
<h2>Professions</h2>
<?php foreach ($user_professions as $profession_key => $user_profession): ?>
<h3>[[Special:Professions#profession-<?php echo $profession_key ?>|<?php echo $user_profession->title ?>]]</h3>
Level <?php echo $user_profession->level ?> (<?php echo $user_profession->kudos ?> Kudos)
<?php endforeach ?>
<?php endif ?>
<h2>Unlocked achievements</h2>
<AchievementList user="<?php echo $username ?>" />
