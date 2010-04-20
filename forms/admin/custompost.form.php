<form method="post" action="" onsubmit="return validate_post_form()">
<input type="hidden" name="cpt[id]" value="<?php echo $cpt["id"]; ?>" />
<table class="form-table"><tbody>
<tr><th scope="row"><?php _e("Name", "gd-taxonomies-tools"); ?></th>
    <td>
        <input<?php echo $cpt["id"] > 0 ? " readonly" : ""; ?> type="text" value="<?php echo $cpt["name"]; ?>" id="cptname" name="cpt[name]" class="input-text-middle<?php echo $cpt["id"] > 0 ? " disabled" : ""; ?>" />
        <div class="gdsr-table-split"></div>
        <?php _e("This must be unique name, not used by any other default or custom post type.", "gd-taxonomies-tools"); ?><br />
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
                    <input type="text" id="cptlabel" value="<?php echo $cpt["label"]; ?>" name="cpt[label]" class="input-text-middle" />
                </td>
            </tr>
            <?php if ($wpv > 29) { ?>
            <tr>
                <td width="150" style="vertical-align: top;">
                    <?php _e("Singular", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="3">
                    <input type="text" id="cptlabelsingular" value="<?php echo $cpt["label_singular"]; ?>" name="cpt[label_singular]" class="input-text-middle" />
                </td>
            </tr>
            <?php } ?>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("This is the display name for the custom post type.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Features", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" style="vertical-align: top;">
                    <?php _e("Select", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="3">
                    <?php
                        foreach ($post_features as $code => $name) {
                            echo sprintf('<input type="checkbox" name="cpt[supports][]"%s value="%s" /><label style="margin-left: 5px;">%s</label><br/>',
                                    in_array($code, $cpt["supports"]) ? " checked" : "", $code, $name);
                        }
                    ?>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr><th scope="row"><?php _e("Taxonomies", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" style="vertical-align: top;">
                    <?php _e("Select", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="3">
                    <?php
                        foreach ($wp_taxonomies as $code => $tax) {
                            echo sprintf('<input type="checkbox" name="cpt[taxonomies][]"%s value="%s" /><label style="margin-left: 5px;">%s [%s]</label><br/>',
                                    in_array($code, $cpt["taxonomies"]) ? " checked" : "", $code, $tax->label, $code);
                        }
                    ?>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr><th scope="row"><?php _e("Visibility", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" valign="top">
                    <?php _e("Public", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top">
                    <select name="cpt[public]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["public"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["public"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150" valign="top">
                    <?php _e("Show UI", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top">
                    <select name="cpt[ui]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["ui"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["ui"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("Public setting set to NO will hide posts from the admin UI. Show UI will generate standard UI for post type management. Either of these set to NO will hide the edit panel.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Settings", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" valign="top">
                    <?php _e("Hierarchical", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top">
                    <select name="cpt[hierarchy]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["hierarchy"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["hierarchy"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" valign="top">
                    <?php _e("Rewrite", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top">
                    <select name="cpt[rewrite]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["rewrite"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["rewrite"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150" valign="top">
                    <?php _e("Query Variable", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230" valign="top">
                    <select name="cpt[query]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["query"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["query"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("Allow post hierarchy similar to default Pages type.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Advanced", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" style="vertical-align: top;">
                    <?php _e("Capabilities", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="3">
                    <input type="text" value="<?php echo $cpt["capability_type"]; ?>" name="cpt[capability_type]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150" style="vertical-align: top;">
                    <?php _e("Edit Link", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="3">
                    <input type="text" value="<?php echo $cpt["edit_link"]; ?>" name="cpt[edit_link]" class="input-text-middle" />
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("Do not change this if you are not sure about this. Consult WordPress documentation for more details.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
</tbody></table>
<input type="submit" class="inputbutton" value="<?php _e("Save Custom Post", "gd-taxonomies-tools"); ?>" name="gdtt_savecpt" style="margin-top: 10px;" />

</form>