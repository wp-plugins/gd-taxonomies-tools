<?php

$editor = true;
$tax = array(
        "id" => 0,
        "name" => "",
        "label" => "",
        "domain" => "post",
        "hierarchy" => "no",
        "rewrite" => "yes_name",
        "rewrite_custom" => "",
        "query" => "yes_name",
        "query_custom" => "",
        "active" => 1
    );

if ($errors == "name") gdtt_render_alert("Error", __("Name for the taxonomy is invalid. Fix before proceeding.", "gd-taxonomies-tools"));

if (isset($_POST["gdtt_savetax"])) {
    $tax = $this->edit_tax;
    if ($errors == "") {
        $editor = false;
        gdtt_render_notice("Taxonomy", __("New taxonomy added.", "gd-taxonomies-tools"));
        ?>
        <div class="inputbutton" style="margin-top: 10px;"><a href="admin.php?page=gdtaxtools_taxs"><?php _e("Go Back", "gd-taxonomies-tools"); ?></a></div>
        <?php
    }
}

if ($editor) include(GDTAXTOOLS_PATH."forms/admin/taxonomy.form.php");

?>