<?php 

require_once __DIR__ . '/bootstrap.php';

if( isset($_GET['url']) && !empty($_GET['url']) ) {

	$url = $_GET['url'];

	$api = new ShaarliApiClient( SHAARLI_API_URL );
	$entries = $api->discussion( $url );
}

$layout = !isset($_GET['ajax']);

if( $layout ) {
	include __DIR__ . '/includes/header.php';
	include __DIR__ . '/includes/menu.php';	
}

?>
<?php if( isset($entries) ): ?>
<?php if( !empty($entries) ): ?>
<div id="entries">
<div class="entry">
	<a class="btn btn-default" href="./discussion.php?url=<?php echo htmlentities($entries[0]->permalink); ?>" title="Discussion permalink" style="float:right;"><span class="glyphicon glyphicon-link"></span></a>	
	<h3 style="margin:0;"><?php echo ($entries[0]->title); ?></h3>
	<p><a target="_blank" href="<?php echo htmlentities($entries[0]->permalink); ?>" style="margin:0;"><?php echo htmlentities($entries[0]->permalink); ?></a></p>
</div>
<?php

foreach( $entries as $entry ) {

	include __DIR__ . '/includes/entry.php';
}

?>
</div>
<?php else: ?>
<div>
	<p>No result.</p>
</div>
<?php endif; ?>
<?php endif; ?>
<?php if( $layout ) include __DIR__ . '/includes/footer.php'; ?>