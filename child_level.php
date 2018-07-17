<?php

$level = count(get_post_ancestors( $post->ID )) + 1;

switch($level) {
    case 1:
        echo "one";
    break;
    case 2:
        echo "two";
    break;
    case 3:
        echo "three";
    break;

    // etc.
}
