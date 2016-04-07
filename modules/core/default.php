<?php

add_filter('sanitize_file_name', 'remove_accents');

remove_action('do_feed_rdf', 'do_feed_rdf' , 10, 1);
remove_action('do_feed_rss', 'do_feed_rss' , 10, 1);
remove_action('do_feed_rss2', 'do_feed_rss2', 10, 1);
remove_action('do_feed_atom', 'do_feed_atom', 10, 1);
remove_action('template_redirect', 'redirect_canonical');
