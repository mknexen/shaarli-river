<?php 

require_once __DIR__ . '/bootstrap.php';

if( isset($_GET['json']) ) {

	$last_id = (isset($_GET['id']) && (int) $_GET['id'] > 0) ? (int) $_GET['id'] : 0;

	$api = new ShaarliApiClient( SHAARLI_API_URL );
	$rows = $api->latest();
	$rows = array_reverse($rows);

	$json = array();

	$json['id'] = 0;
	$json['entries'] = array();

	foreach( $rows as $row ) {

		if( $row->id > $last_id ) {

			$entry = array();

			$content = array();
			$content[] = '<div class="entry">';
			$content[] = '<div class="entry-timestamp">' . date('d/m/Y H:i:s', strtotime($row->date)) . '</div>';			
			$content[] = '<a class="entry-shaarli" target="_blank" href="' . @$row->feed->link . '">';
			$content[] = '<img class="favicon" src="' . get_favicon_url($row->feed->id)  .'" />' . $row->feed->title . '</a> ';
			$content[] = '<a class="entry-title" target="_blank" href="' . $row->permalink . '">' . $row->title . '</a>';
			$content[] = '<div class="entry-content">' . $row->content . '</div>';
			$content[] = '</div>';

			$entry['content'] = implode($content);
			unset($content);

			$json['entries'][] = $entry;
		}

		if( $row->id > $json['id'] ) { // Max id
			$json['id'] = $row->id;
		}
	}

	$json['count'] = count($json['entries']);

	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Content-type: application/json');
	echo json_encode($json);
	exit();
}

$header_rss = SHAARLI_API_URL . 'latest?format=rss';
include __DIR__ . '/includes/header.php';
?>

<div style="float:right;">
	<a class="btn btn-default" target="_blank" href="<?php echo SHAARLI_API_URL; ?>latest?pretty=1">JSON</a>
	<a class="btn btn-default" target="_blank" href="<?php echo SHAARLI_API_URL; ?>latest?format=rss">RSS</a>
</div>

<?php include __DIR__ . '/includes/menu.php'; ?>

<div id="entries"></div>
<script type="text/javascript">

var id = '';
var timer = 1000;

function river() {

	if( timer > 99 ) {

		$.ajax({ 
			type: 'GET',
			url: 'index.php?json=1&id='+id,
			async: false,
			dataType: 'json',
			success: function( json ) {
				if( json.count > 0 ) {
					if( timer == 1000 ) {
						$.each(json.entries, function( id, entry ) {
							$('#entries').prepend(entry.content);
						});
					}
					else {
			        	$.each(json.entries, function( id, entry ) {
			        		var node = $(entry.content);
		        			node.addClass('unread');
		        			node.hover(function() {
		        				$(this).removeClass('unread');
		        				count_unread();
		        			});
			        		node.hide();
			        		$('#entries').prepend(node);
			        		node.slideDown();
						});						
					}
					id = json.id;
					count_unread();
				}
		}});

		timer = 0;		
	}
	else {
		timer++;
		if( timer > 99 )
			$('#timer').text('Checking...');
		else
			$('#timer').text(timer);
	}

	setTimeout('river()', 100);
}
function count_unread() {
	var title = "<?php echo HEAD_TITLE; ?>";
	var unread = $('.unread').size();
	if( unread > 0 ) {
		$('title').text('('+unread+') '+title);
	}
	else {
		$('title').text(title);
	}
}
$(function() {
	river();
	$('#link-river').addClass('btn-primary');
});
</script>
<?php include __DIR__ . '/includes/footer.php'; ?>