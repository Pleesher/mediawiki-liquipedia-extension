<?php foreach ( $professions as $profession_key => $profession ): ?>
	<?php echo PleesherExtension::render( 'profession', [ 'profession_key' => $profession_key, 'profession' => $profession ] ); ?>
<?php endforeach; ?>