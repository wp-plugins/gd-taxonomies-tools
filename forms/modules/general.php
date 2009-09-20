<?php

global $wp_taxonomies;
$defaults = array("category", "post_tag", "link_category");

?>

<div id="gdpt_server" class="postbox gdrgrid frontright">
    <h3 class="hndle"><span><?php _e("Basic statistics", "gd-taxonomies-tools"); ?></span></h3>
    <div class="inside">
        <p class="sub"><?php _e("Default Taxonomies", "gd-taxonomies-tools"); ?></p>
        <div class="table">
            <table><tbody>
                <tr class="first">
                    <td class="first b">Categories</td>
                    <td class="t"><?php _e("for", "gd-taxonomies-tools"); ?> <strong><?php _e("posts", "gd-taxonomies-tools"); ?></strong>, <?php _e("hierarchical", "gd-taxonomies-tools"); ?></td>
                    <td class="b options" style="font-weight: bold;"><?php echo count(get_terms("category")); ?></td>
                </tr>
                <tr>
                    <td class="first b">Post Tags</td>
                    <td class="t"><?php _e("for", "gd-taxonomies-tools"); ?> <strong><?php _e("posts", "gd-taxonomies-tools"); ?></strong></td>
                    <td class="b options" style="font-weight: bold;"><?php echo count(get_terms("post_tag")); ?></td>
                </tr>
                <tr>
                    <td class="first b">Categories</td>
                    <td class="t"><?php _e("for", "gd-taxonomies-tools"); ?> <strong><?php _e("links", "gd-taxonomies-tools"); ?></strong></td>
                    <td class="b options" style="font-weight: bold;"><?php echo count(get_terms("link_category")); ?></td>
                </tr>
            </tbody></table>
        </div>
        <?php if (count($wp_taxonomies) > 3) { $first = true; ?>
        <p class="sub"><?php _e("Custom Taxonomies", "gd-taxonomies-tools"); ?></p>
        <div class="table">
            <table><tbody>
            <?php foreach ($wp_taxonomies as $short => $tax) { if (!in_array($tax->name, $defaults)) { ?>
                <tr<?php echo $first ? ' class="first"' : ''; $first = false; ?>>
                    <td class="first b"><?php echo $tax->label; ?></td>
                    <td class="t"><?php _e("for", "gd-taxonomies-tools"); ?> <strong><?php echo $tax->object_type; ?>s</strong><?php if ($tax->hierarchical == 1) echo ", ".__("hierarchical", "gd-taxonomies-tools"); ?></td>
                    <td class="b options" style="font-weight: bold;"><?php echo count(get_terms($tax->name)); ?></td>
                </tr>
             <?php } } ?>
            </tbody></table>
        </div>
        <?php } ?>
    </div>
</div>
