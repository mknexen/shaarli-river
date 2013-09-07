<?php 

	require_once __DIR__ . '/includes/ShaarliApiClient.php';

	if( isset($_GET['month']) ) {

		$entries = ShaarliApiClient::getTopMonth();
	}
	else {

		$entries = ShaarliApiClient::getTopToday();
	}

	include __DIR__ . '/includes/header.php';

?>
<div id="entries">
	<?php foreach( $entries as $entry ): ?>
	<div class="entry">
		<div class="entry-counter"><?php echo $entry->count; ?></div>
		<a class="entry-title" target="_blank" href="<?php echo $entry->permalink; ?>"><?php echo $entry->title; ?></a>
	</div>
	<?php endforeach; ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>