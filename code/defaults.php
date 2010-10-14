<?php

class GDTTDefaults {
    var $default_options = array(
        "version" => "1.2.9",
        "date" => "2010.10.14.",
        "status" => "Stable",
        "build" => 1290,
        "product_id" => "gd-taxonomies-tools",
        "edition" => "lite",
        "upgrade_to_pro_12" => 1,
        "force_rules_flush" => 0,
        "tax_internal" => 0,
        "cpt_internal" => 0,
        "delete_taxonomy_db" => 0,
        "tinymce_auto_create" => 1,
        "tinymce_search_limit" => 5
    );

    var $default_taxonomies = array(
        "wp28" => 3,
        "wp29" => 3,
        "wp30" => 4,
        "wp31" => 4
    );

    var $default_posttypes = array(
        "wp30" => 5,
        "wp31" => 5
    );

    function GDTTDefaults() { }
}

?>