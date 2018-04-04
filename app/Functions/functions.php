<?php

use Route as route;

function subMenu ($categories, $id) {
    echo '<ul>';
    foreach ($categories as $item) {
        if ($item['parent_id'] == $id) {
            echo '<li> <a href="' . route('list-product', $item['id']) . '"> ' . $item['category_name'] . ' </a>';
            subMenu($categories, $item['id']);
            echo '</li>';
        }
    }
    echo '</ul>';
}
