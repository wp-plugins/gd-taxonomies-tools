<?php

class GDTTDefaults {
    var $default_options = array(
        "version" => "0.7.0",
        "date" => "2009.11.22.",
        "status" => "Beta",
        "build" => 25,
        "edition" => "lite",
        "tax_internal" => 0,
        "delete_taxonomy_db" => 0,
        "sitemap_expand" => 1,
        "tinymce_auto_create" => 1,
        "tinymce_search_limit" => 5
    );

    var $default_taxonomies = array(
        "wp28" => 3,
        "wp29" => 3
    );

    function GDTTDefaults() { }
}

?>