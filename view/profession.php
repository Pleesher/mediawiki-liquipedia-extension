<article id="profession-<?php echo $profession_key; ?>">
	<h1><?php echo htmlspecialchars( $profession->title ); ?></h1>
	<?php echo htmlspecialchars( $profession->description ); ?>

	<h2><?php echo $h->text( 'liquigoals.profession.levels.title' ); ?></h2>
	<ul>
		<?php foreach ( $profession->levels_kudos as $level => $kudos ): ?>
			<li>Level <?php echo $level + 1; ?> : <?php echo $kudos; ?> Kudos</li>
		<?php endforeach; ?>
	</ul>
</article>