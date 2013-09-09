<?php

require_once __DIR__ . '/bootstrap.php';

$feeds = ShaarliApiClient::callApi('feeds');
if( empty($feeds) ) die('API return empty content');

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
<a class="btn btn-default" target="_blank" href="<?php echo $feed->link; ?>"><?php echo $feed->title; ?></a> 
<?php endif; ?>
<?php endforeach; ?>

<script type="text/javascript">
$(function() {
	$('#link-network').addClass('btn-primary');
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>