<?php echo PleesherExtension::render('goal', [
	'user' => isset($user) ? $user : null,
	'goal' => $goal
]) ?>

<?php if ($goal->description): ?>
<h2><?php echo $h->text('pleesher.goal.description.title') ?></h2>
<p><?php echo nl2br($goal->description) ?></p>
<?php endif ?>

<?php if (count($goal->professions) > 0): ?>
<h2><?php echo $h->text('liquigoals.goal.associated_professions.title') ?></h2>
<ul>
	<?php foreach ($goal->professions as $profession_key => $profession): ?>
	<li><a href="<?php echo $h->pageUrl('Special:Professions') ?>#profession-<?php echo $profession_key ?>"><?php echo $profession->title ?></a></li>
	<?php endforeach ?>
</ul>
<?php endif ?>

<?php if (count($achievers) > 0): ?>
<h2><?php echo $h->text('pleesher.goal.achievers.title') ?></h2>
<ul>
	<?php foreach ($achievers as $achiever): ?>
	<li><a href="<?php echo $h->pageUrl('User:' . $achiever->getName()) ?>"><?php echo $achiever->getName() ?></a></li>
	<?php endforeach ?>
</ul>
<?php endif ?>