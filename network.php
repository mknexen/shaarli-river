<?php

require_once __DIR__ . '/bootstrap.php';

$api = new ShaarliApiClient( SHAARLI_API_URL );
$feeds = $api->feeds( $shaarli_api_extra_args );

shuffle($feeds);

include __DIR__ . '/includes/header.php'; ?>

<div style="float:right;">
	<a class="btn btn-default" target="_blank" href="<?php echo SHAARLI_API_URL; ?>feeds?pretty=1">JSON</a>
	<a class="btn btn-default" target="_blank" href="<?php echo SHAARLI_API_URL; ?>feeds?format=opml">OPML</a>
</div>

<?php include __DIR__ . '/includes/menu.php'; ?>

<h3>The Network (<?php echo count($feeds); ?> peoples)</h3>

<?php foreach( $feeds as $feed ): ?>
<?php if( !empty($feed->link) && !empty($feed->title) ): ?>
<a class="btn btn-default" target="_blank" href="<?php echo $feed->link; ?>"><img class="favicon" src="<?php echo get_favicon_url($feed->id); ?>" /><?php echo $feed->title; ?></a> 
<?php endif; ?>
<?php endforeach; ?>

<script type="text/javascript">
$(function() {
	$('#link-network').addClass('btn-primary');
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>