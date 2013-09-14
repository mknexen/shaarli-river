<?php 

require_once __DIR__ . '/bootstrap.php';

/**
 * Top shared links - RSS Feed
 */
if( isset($_GET['do']) && $_GET['do'] == 'rss' ) {

	require_once __DIR__ . '/includes/create_rss.php';

	$entries = ShaarliApiClient::callApi('bestlinks');

	if( !empty($entries) ) {

		foreach( $entries as &$entry ) {

			$entry->content = implode(array(
				'<a href="',
				$entry->feed->link,
				'">',
				$entry->feed->title,
				'</a>:<br />',
				$entry->content,
				' (<a href="',
				SHAARLI_RIVER_URL,
				'discussion.php?url=',
				urlencode($entry->permalink),
				'">Discussion</a>)',
			));
		}

		create_rss( $entries, array(
			'title' => 'Shaarli River - Les liens les plus partagés'
		));
	}

	exit();
}

/**
 * Top shared links - Page
 */
$intervals = array(
	'12h' => 'Last 12h',
	'24h' => 'Last 24h',
	'48h' => 'Last 48h',
	'1month' => 'Last month',
	'3month' => 'Last 3 months',
	'alltime' => 'Alltime',
);

$interval = isset($_GET['interval']) && isset($intervals[$_GET['interval']]) ? $_GET['interval'] : '24h';

$entries = ShaarliApiClient::callApi('top?interval='.$interval);

$header_rss = './top.php?do=rss';
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/menu.php';

?>
<div class="menu">
	<?php foreach( $intervals as $key => $libelle ): ?>
	<a class="btn btn-<?php echo ($key == $interval) ? 'primary' : 'default'; ?>" href="./top.php?interval=<?php echo $key; ?>"><?php echo $libelle; ?></a>
	<?php endforeach; ?>
</div>

<div class="two-column">
	<?php foreach( $entries as $entry ): ?>
	<div class="entry-link">
		<div class="entry-counter"><?php echo $entry->count; ?></div>
		<a class="entry-title" target="_blank" href="<?php echo $entry->permalink; ?>"><?php echo $entry->title; ?></a>
		<div class="clear"></div>
	</div>
	<?php endforeach; ?>
</div>
<div id="entries-column" class="two-column"></div>
<div class="clear"></div>
<script type="text/javascript">
$(function() {
	$('#link-top').addClass('btn-primary');
	$('.entry-link').click(function() {
		$('.entry-link').removeClass('selected');
		$(this).addClass('selected');
		var url = $(this).find('a:first').attr('href');
		$.ajax({ 
			type: 'GET',
			url: './discussion.php',
			data: { 'url': url, 'ajax': 1 },
			async: false,
			success: function( html ) {
				$('#entries-column').html(html);
		}});

		return false;
	});
	$('.entry-title:first').click();
});
</script>
<?php include __DIR__ . '/includes/footer.php'; ?>