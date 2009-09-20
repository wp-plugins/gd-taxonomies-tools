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
        <input type="text" id="taxlabel" value="<?php echo $tax["label"]; ?>" name="tax[label]" class="input-text-middle" />
        <div class="gdsr-table-split"></div>
        <?php _e("This is the display name for the taxonomy.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Settings", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" valign="top">
                    <?php _e("Domain", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top" colspan="3">
                    <select<?php echo $wpv == 28 ? " disabled" : ""; ?> name="tax[domain]" class="input-text-middle">
                        <option value="post"<?php echo $tax["domain"] == "post" ? ' selected="selected"' : ''; ?>><?php _e("Posts", "gd-taxonomies-tools"); ?></option>
                        <option value="link"<?php echo $tax["domain"] == "link" ? ' selected="selected"' : ''; ?>><?php _e("Links", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150" valign="top">
                    <?php _e("Hierarchical", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top" colspan="3">
                    <select<?php echo $wpv == 28 ? " disabled" : ""; ?> name="tax[hierarchy]" class="input-text-middle">
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
                        <?php if ($wpv != 28) { ?><option value="yes_custom"<?php echo $tax["rewrite"] == "yes_custom" ? ' selected="selected"' : ''; ?>><?php _e("Yes, custom value", "gd-taxonomies-tools"); ?></option><?php } ?>
                        <option value="no"<?php echo $tax["rewrite"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td width="100" valign="top">
                    <?php _e("Custom", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <input<?php echo $wpv == 28 ? " disabled" : ""; ?> type="text" value="<?php echo $tax["rewrite_custom"]; ?>" name="tax[rewrite_custom]" class="input-text-middle" />
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
        <?php if ($wpv == 28) _e("With WP 2.8.x not all options work, and they are disabled.", "gd-taxonomies-tools"); ?>
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
