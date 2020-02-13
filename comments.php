<?php

wp_list_comments(array(
	'style'         => 'ol',
	'max_depth'     => 4,
	'short_ping'    => true,
	'avatar_size'   => '50',
	'walker'        => new Bootstrap_Comment_Walker(),
));

?>

