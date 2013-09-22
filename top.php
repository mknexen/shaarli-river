<?php 

require_once __DIR__ . '/bootstrap.php';

/**
 * Top shared links - RSS Feed
 */
if( isset($_GET['do']) && $_GET['do'] == 'rss' ) {

	require_once __DIR__ . '/includes/create_rss.php';

	$api = new ShaarliApiClient( SHAARLI_API_URL );
	$data = $api->top(array('date' => date('Y-m-d', strtotime('-1 days'))));

	$feed_entry = new stdClass();

	if( isset($data->entries) && !empty($data->entries) ) {

		$content = array();
		$content[] = '<ul>';

		foreach( $data->entries as $link ) {

			$content[] = '<li>[';
			$content[] = $link->count;
			$content[] = '] <a href="';
			$content[] = $link->permalink;
			$content[] = '">';
			$content[] = $link->title;
			$content[] = '</a>';
			$content[] = ' (<a href="';
			$content[] = SHAARLI_RIVER_URL;
			$content[] = 'discussion.php?url=';
			$content[] = urlencode($link->permalink);
			$content[] = '">Discussion</a>)';
			$content[] = '</li>';
		}

		$content[] = '</ul>';
		$content = implode($content);
		
		$feed_entry->title = 'Top du ' . date('d/m/Y', strtotime($data->date));
		$feed_entry->content = $content;
		$feed_entry->date = $data->date;
	}

	$feed = array(
		$feed_entry,
	);

	create_rss( $feed, array(
		'title' => 'Shaarli River - Les liens les plus partagés'
	));

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

$api = new ShaarliApiClient( SHAARLI_API_URL );
$entries = $api->top(array('interval' => $interval));

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