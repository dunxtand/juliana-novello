<?php

function get_menu_items () {
    $menu = new TimberMenu( 'Main Navigation' );

    $menu_items = array_map(
        function ( $item ) {
            return [
                'title' => $item->name,
                'link' => $item->path,
                'image' => (new TimberImage( $item->image ))->src
            ];
        },
        $menu->items
    );

    return $menu_items;
}
