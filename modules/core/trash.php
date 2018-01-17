<?php

function remove_schedule_delete() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}
add_action('init', 'remove_schedule_delete');
