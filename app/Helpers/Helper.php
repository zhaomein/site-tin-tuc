<?php 

function get_post_link($post) {
    return '/'.$post->category->slug.'/'.$post->slug.'_pid-'.$post->id.'.html';
}

function get_category_link($cat) {
    return '/'.$cat->slug;
}

function get_author_link($author) {
    return '/author_'.$author->username;
}

function get_post_date($post) {
    return date('H:i d/m/Y', strtotime($post->created_at));
}

function get_post_thumb($post) {
    return '/uploads/'.$post->thumb;
}