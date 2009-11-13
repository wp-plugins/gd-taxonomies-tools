<table class="gdsw-table">
    <tr>
        <td class="tdleft"><?php _e("Show number of posts", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright">
            <input <?php echo $instance['display_count'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('display_count'); ?>" name="<?php echo $this->get_field_name('display_count'); ?>" />
        </td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("Additional CSS class", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright"><input class="widefat gdsw-input-text" id="<?php echo $this->get_field_id('display_css'); ?>" name="<?php echo $this->get_field_name('display_css'); ?>" type="text" value="<?php echo $instance["display_css"]; ?>" /></td>
    </tr>
</table>
