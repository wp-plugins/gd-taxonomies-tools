<?php

$editor = true;
$cpt = array(
        "id" => 0,
        "name" => "",
        "label" => "",
        "label_singular" => "",
        "public" => "yes",
        "ui" => "yes",
        "hierarchy" => "no",
        "rewrite" => "yes",
        "query" => "yes_name",
        "capability_type" => "post",
        "edit_link" => "post.php?post=%d",
        "supports" => array("title", "editor", "excerpts", "trackbacks", "custom-fields", "comments", "revisions", "post-thumbnails"),
        "taxonomies" => array("category", "post_tag")
    );

if ($errors == "name") {
    gdtt_render_alert("Error", __("Name for the custom post type is invalid. Fix before proceeding.", "gd-taxonomies-tools"));
}

if (isset($_POST["gdtt_savecpt"])) {
    $cpt = $this->edit_cpt;
    if ($errors == "") {
        $editor = false;
        gdtt_render_notice("Custom Post Type", __("New custom post type added.", "gd-taxonomies-tools"));
        ?>
        <div class="inputbutton" style="margin-top: 10px;"><a href="admin.php?page=gdtaxtools_postypes"><?php _e("Go Back", "gd-taxonomies-tools"); ?></a></div>
        <?php
    }
}

if ($editor) include(GDTAXTOOLS_PATH."forms/admin/custompost.form.php");

?>