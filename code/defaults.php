<?php

class GDTTDefaults {
    var $default_options = array(
        "version" => "1.0.1",
        "date" => "2010.02.15.",
        "status" => "Stable",
        "build" => 28,
        "edition" => "lite",
        "tax_internal" => 0,
        "delete_taxonomy_db" => 0,
        "sitemap_expand" => 0,
        "tinymce_auto_create" => 1,
        "tinymce_search_limit" => 5
    );

    var $default_taxonomies = array(
        "wp28" => 3,
        "wp29" => 3,
        "wp30" => 3
    );

    function GDTTDefaults() { }
}

?>