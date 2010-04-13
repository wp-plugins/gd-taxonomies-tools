<form method="post" action="" onsubmit="return validate_tax_form()">
<input type="hidden" name="tax[id]" value="<?php echo $tax["id"]; ?>" />
<table class="form-table"><tbody>
<tr><th scope="row"><?php _e("Name", "gd-taxonomies-tools"); ?></th>
    <td>
        <input<?php echo $tax["id"] > 0 ? " readonly" : ""; ?> type="text" value="<?php echo $tax["name"]; ?>" id="taxname" name="tax[name]" class="input-text-middle<?php echo $tax["id"] > 0 ? " disabled" : ""; ?>" />
        <?php if ($tax["id"] > 0 && false) { ?>
        <br /><input type="checkbox" name="tax[rename]" /><label style="margin-left: 5px;"><?php _e("Allow renaming of the taxonomy name. This will cause renaming all database entries for this taxonomy.", "gd-taxonomies-tools"); ?></label>
        <?php } ?>
        <div class="gdsr-table-split"></div>
        <?php _e("This must be unique name, not used by any other taxonomy.", "gd-taxonomies-tools"); ?><br />
        <?php _e("Also, use only lower case letters and no special characters except for the underscore.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Label", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" style="vertical-align: top;">
                    <?php _e("Standard", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="3">
                    <input type="text" id="taxlabel" value="<?php echo $tax["label"]; ?>" name="tax[label]" class="input-text-middle" />
                </td>
            </tr>
            <?php if ($wpv > 29) { ?>
            <tr>
                <td width="150" style="vertical-align: top;">
                    <?php _e("Singular", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="3">
                    <input type="text" id="taxlabelsingular" value="<?php echo $tax["label_singular"]; ?>" name="tax[label_singular]" class="input-text-middle" />
                </td>
            </tr>
            <?php } ?>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("This is the display name for the taxonomy. Standard value is usually plural. Singular is added in WordPress 3.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Post Types", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" style="vertical-align: top;">
                    <?php _e("Select", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="3">
                    <?php
                        foreach ($post_types as $pt) {
                            echo sprintf('<input type="checkbox" name="tax[post_type][]"%s value="%s" /><label style="margin-left: 5px;">%s [%s]</label><br/>',
                                    in_array($pt->name, $tax["domain"]) ? " checked" : "", $pt->name, $pt->label, $pt->name);
                        }
                    ?>
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("At least one type must be selected. If not, Posts type will be added by default.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<?php if ($tax["id"] > 0 && false) { ?>
<tr><th scope="row"><?php _e("Visibility", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" valign="top">
                    <?php _e("Public", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top">
                    <select name="tax[public]" class="input-text-middle">
                        <option value="yes"<?php echo $tax["public"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $tax["public"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150" valign="top">
                    <?php _e("Show UI", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top">
                    <select name="tax[ui]" class="input-text-middle">
                        <option value="yes"<?php echo $tax["ui"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $tax["ui"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150" valign="top">
                    <?php _e("Tag Cloud Widget", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top">
                    <select name="tax[cloud]" class="input-text-middle">
                        <option value="yes"<?php echo $tax["cloud"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $tax["cloud"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("Public setting set to NO will hide taxonomies from the admin UI.", "gd-taxonomies-tools"); ?><br/>
        <?php _e("Tag cloud option set to NO will exclude this taxonomy from default Tag Cloud widget.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<?php } ?>
<tr><th scope="row"><?php _e("Settings", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" valign="top">
                    <?php _e("Hierarchical", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top" colspan="3">
                    <select<?php echo $wpv < 30 ? " disabled" : ""; ?> name="tax[hierarchy]" class="input-text-middle">
                        <option value="no"<?php echo $tax["hierarchy"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                        <option value="yes"<?php echo $tax["hierarchy"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150" valign="top">
                    <?php _e("Rewrite", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top">
                    <select name="tax[rewrite]" class="input-text-middle">
                        <option value="yes_name"<?php echo $tax["rewrite"] == "yes_name" ? ' selected="selected"' : ''; ?>><?php _e("Yes, using name", "gd-taxonomies-tools"); ?></option>
                        <?php if ($wpv > 29) { ?><option value="yes_custom"<?php echo $tax["rewrite"] == "yes_custom" ? ' selected="selected"' : ''; ?>><?php _e("Yes, custom value", "gd-taxonomies-tools"); ?></option><?php } ?>
                        <option value="no"<?php echo $tax["rewrite"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td width="100" valign="top">
                    <?php _e("Custom", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <input<?php echo $wpv < 30 ? " disabled" : ""; ?> type="text" value="<?php echo $tax["rewrite_custom"]; ?>" name="tax[rewrite_custom]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150" valign="top">
                    <?php _e("Query Variable", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top">
                    <select name="tax[query]" class="input-text-middle">
                        <option value="yes_name"<?php echo $tax["query"] == "yes_name" ? ' selected="selected"' : ''; ?>><?php _e("Yes, using name", "gd-taxonomies-tools"); ?></option>
                        <option value="yes_custom"<?php echo $tax["query"] == "yes_custom" ? ' selected="selected"' : ''; ?>><?php _e("Yes, custom value", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $tax["query"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td width="100" valign="top">
                    <?php _e("Custom", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <input type="text" value="<?php echo $tax["query_custom"]; ?>" name="tax[query_custom]" class="input-text-middle" />
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("For rewrite and query custom variables use only lower case letters and no special characters except for the underscore.", "gd-taxonomies-tools"); ?><br />
        <?php if ($wpv < 30) _e("With WP 2.8.x and WP 2.9.x not all options work, and they are disabled. Once the WordPress starts supporting this option, they will be enabled.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Status", "gd-taxonomies-tools"); ?></th>
    <td>
        <input<?php if (isset($tax["active"])) echo " checked"; ?> type="checkbox" name="tax[active]" /><label style="margin-left: 5px;"><?php _e("Taxonomy is set to active.", "gd-taxonomies-tools"); ?></label>
    </td>
</tr>
</tbody></table>
<input type="submit" class="inputbutton" value="<?php _e("Save Taxonomy", "gd-taxonomies-tools"); ?>" name="gdtt_savetax" style="margin-top: 10px;" />
</form>
