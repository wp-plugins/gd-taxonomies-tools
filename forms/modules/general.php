<?php

global $gdtt, $wp_taxonomies;
$defaults = array("category", "post_tag", "link_category");

$tax_default = array_slice($wp_taxonomies, 0, $gdtt->get_defaults_count());
$tax_custom = array_slice($wp_taxonomies, $gdtt->get_defaults_count());


?>

<div id="gdpt_server" class="postbox gdrgrid frontright">
    <h3 class="hndle"><span><?php _e("Basic statistics", "gd-taxonomies-tools"); ?></span></h3>
    <div class="inside">
        <p class="sub"><?php _e("Default Taxonomies", "gd-taxonomies-tools"); ?></p>
        <div class="table">
            <table><tbody>
                <?php $first = true;
                    foreach ($tax_default as $short => $tax) {
                        include(GDTAXTOOLS_PATH."forms/render/tax.front.php");
                        $first = false;
                    }
                ?>
            </tbody></table>
        </div>
        <p class="sub"><?php _e("Custom Taxonomies", "gd-taxonomies-tools"); ?></p>
        <?php if (count($wp_taxonomies) > $gdtt->get_defaults_count()) { ?>
        <div class="table">
            <table><tbody>
            <?php $first = true;
                foreach ($tax_custom as $short => $tax) {
                    include(GDTAXTOOLS_PATH."forms/render/tax.front.php");
                    $first = false;
                }
            ?>
            </tbody></table>
        </div>
        <?php } else _e("No custom taxonomies found.", "gd-taxonomies-tools"); ?>
    </div>
</div>
