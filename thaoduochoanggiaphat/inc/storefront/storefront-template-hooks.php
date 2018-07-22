<?php

add_action( 'after_setup_theme', 'handle_parent_action', 20 );
add_action( 'init', 'remove_parent_action_in_init', 100);

