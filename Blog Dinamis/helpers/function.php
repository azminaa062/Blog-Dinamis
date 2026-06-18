<?php

function base_url($path = '')
{
    return "http://localhost/blog_dinamis/" . $path;
}

function slugify($text)
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}

function esc($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
?>