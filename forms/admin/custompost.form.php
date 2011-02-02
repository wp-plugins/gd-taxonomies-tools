<form method="post" action="" onsubmit="return validate_post_form()">
<input type="hidden" name="cpt[id]" value="<?php echo $cpt["id"]; ?>" />
<table class="form-table"><tbody>
<tr><th scope="row"><?php _e("Name", "gd-taxonomies-tools"); ?></th>
    <td>
        <input maxlength="20"<?php echo $cpt["id"] > 0 ? " readonly" : ""; ?> type="text" value="<?php echo $cpt["name"]; ?>" id="cptname" name="cpt[name]" class="input-text-middle<?php echo $cpt["id"] > 0 ? " disabled" : ""; ?>" />
        <div class="gdsr-table-split"></div>
        <div class="gdsr-major-info">
            <?php _e("This must be unique name, not used by any other default or custom post type.", "gd-taxonomies-tools"); ?><br />
            <?php _e("Also, use only lower case letters and no special characters except for the underscore.", "gd-taxonomies-tools"); ?>
        </div>
    </td>
</tr>
<tr><th scope="row"><?php _e("Status", "gd-taxonomies-tools"); ?></th>
    <td>
        <input<?php if ($cpt["active"] == 1) echo " checked"; ?> type="checkbox" name="cpt[active]" /><label style="margin-left: 5px;"><?php _e("This custom post type is set to active and will be registered for use.", "gd-taxonomies-tools"); ?></label>
        <div class="gdsr-table-split"></div>
        <?php _e("If you deactivate this custom post type, all the posts associated with it will remain intact.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Description", "gd-taxonomies-tools"); ?></th>
    <td>
        <input type="text" id="cptdescription" value="<?php echo $cpt["description"]; ?>" name="cpt[description]" class="input-text-extralong" />
        <div class="gdsr-table-split"></div>
        <?php _e("No HTML is allowed.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Labels", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150"><?php _e("Plural Name", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelsname" value="<?php echo $cpt["labels"]["name"]; ?>" name="cpt[labels][name]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Singular Name", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelssingular_name" value="<?php echo $cpt["labels"]["singular_name"]; ?>" name="cpt[labels][singular_name]" class="input-text-middle" />
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <div class="inputbutton"><a href="javascript:autofill_posttype()"><?php _e("Auto fill rest", "gd-taxonomies-tools"); ?></a></div>
        <div class="gdsr-table-split"></div>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150"><?php _e("Add New", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelsadd_new" value="<?php echo $cpt["labels"]["add_new"]; ?>" name="cpt[labels][add_new]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Add New Item", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelsadd_new_item" value="<?php echo $cpt["labels"]["add_new_item"]; ?>" name="cpt[labels][add_new_item]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150"><?php _e("Edit Item", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelsedit_item" value="<?php echo $cpt["labels"]["edit_item"]; ?>" name="cpt[labels][edit_item]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("New Item", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelsnew_item" value="<?php echo $cpt["labels"]["new_item"]; ?>" name="cpt[labels][new_item]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150"><?php _e("View Item", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelsview_item" value="<?php echo $cpt["labels"]["view_item"]; ?>" name="cpt[labels][view_item]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Search Items", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelssearch_items" value="<?php echo $cpt["labels"]["search_items"]; ?>" name="cpt[labels][search_items]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150"><?php _e("Not Found", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelsnot_found" value="<?php echo $cpt["labels"]["not_found"]; ?>" name="cpt[labels][not_found]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Not Found In Trash", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelsnot_found_in_trash" value="<?php echo $cpt["labels"]["not_found_in_trash"]; ?>" name="cpt[labels][not_found_in_trash]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150"><?php _e("Parent Item Colon", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelsparent_item_colon" value="<?php echo isset($cpt["labels"]["parent_item_colon"]) ? $cpt["labels"]["parent_item_colon"] : ""; ?>" name="cpt[labels][parent_item_colon]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Menu Name", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptlabelsmenu_name" value="<?php echo isset($cpt["labels"]["menu_name"]) ? $cpt["labels"]["menu_name"] : ""; ?>" name="cpt[labels][menu_name]" class="input-text-middle" />
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr><th scope="row"><?php _e("Settings", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150">
                    <?php _e("Features", "gd-taxonomies-tools"); ?>:
                </td>
                <td colspan="3">
                    <select name="cpt[supports][]" class="drop-sel-checks" multiple>
                    <?php
                        echo sprintf('<option value="(all)">%s</option>', __("(all)", "gd-taxonomies-tools"));
                        foreach ($post_features as $code => $name) {
                            echo sprintf('<option%s value="%s">%s</option>',
                                    in_array($code, $cpt["supports"]) ? ' selected="selected"' : "",
                                    $code, $name);
                        }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150">
                    <?php _e("Taxonomies", "gd-taxonomies-tools"); ?>:
                </td>
                <td colspan="3">
                    <select name="cpt[taxonomies][]" class="drop-sel-checks" multiple>
                    <?php
                        echo sprintf('<option value="(all)">%s</option>', __("(all)", "gd-taxonomies-tools"));
                        foreach ($wp_taxonomies as $code => $tax) {
                            if ($tax->public && $code != "post_format") {
                                echo sprintf('<option%s value="%s">%s [%s]</option>',
                                    in_array($code, $cpt["taxonomies"]) ? ' selected="selected"' : "",
                                    $code, $tax->label, $code);
                            }
                        }
                    ?>
                    </select>
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150">
                    <?php _e("Archive", "gd-taxonomies-tools"); ?>:
                </td>
                <td>
                    <select name="cpt[archive]" class="input-text-middle">
                        <option value="yes_name"<?php echo $cpt["archive"] == "yes_name" ? ' selected="selected"' : ''; ?>><?php _e("Yes, using name", "gd-taxonomies-tools"); ?></option>
                        <?php if ($wpv > 29) { ?><option value="yes_custom"<?php echo $cpt["archive"] == "yes_custom" ? ' selected="selected"' : ''; ?>><?php _e("Yes, custom value", "gd-taxonomies-tools"); ?></option><?php } ?>
                        <option value="no"<?php echo $cpt["archive"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td style="width: 20px;"></td>
                <td width="150">
                    <?php _e("Custom", "gd-taxonomies-tools"); ?>:
                </td>
                <td>
                    <input type="text" value="<?php echo $cpt["archive_slug"]; ?>" name="cpt[archive_slug]" class="input-text-middle" />
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150">
                    <?php _e("Hierarchical", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230">
                    <select name="cpt[hierarchy]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["hierarchy"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["hierarchy"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150">
                    <?php _e("Rewrite", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230">
                    <select name="cpt[rewrite]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["rewrite"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["rewrite"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150">
                    <?php _e("Query Variable", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230">
                    <select name="cpt[query]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["query"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["query"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150">
                    <?php _e("Capabilites", "gd-taxonomies-tools"); ?>:
                </td>
                <td width="230">
                    <select name="cpt[capabilites]" class="input-text-middle">
                        <option value="type"<?php echo $cpt["capabilites"] == "type" ? ' selected="selected"' : ''; ?>><?php _e("Use Capability Type", "gd-taxonomies-tools"); ?></option>
                        <option value="list"<?php echo $cpt["capabilites"] == "list" ? ' selected="selected"' : ''; ?>><?php _e("Use Capabilities List", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr><th scope="row"><?php _e("Visibility", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150">
                    <?php _e("Public", "gd-taxonomies-tools"); ?>:
                </td>
                <td>
                    <select name="cpt[public]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["public"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["public"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td style="width: 20px;"></td>
                <td width="150">
                    <?php _e("Show UI", "gd-taxonomies-tools"); ?>:
                </td>
                <td>
                    <select name="cpt[ui]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["ui"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["ui"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150">
                    <?php _e("Navigation Menus", "gd-taxonomies-tools"); ?>:
                </td>
                <td colspan="4">
                    <select name="cpt[nav_menus]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["nav_menus"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["nav_menus"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("Public setting set to NO will hide posts from the admin UI. Show UI will generate standard UI for post type management. Either of these set to NO will hide the edit panel.", "gd-taxonomies-tools"); ?>
        <?php _e("Navigational menu option will make custom post type available for building menus.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Capability Type", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150"><?php _e("Name", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcaps_type" value="<?php echo $cpt["caps_type"]; ?>" name="cpt[caps_type]" class="input-text-middle" />
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("Base capability type that will be used to generate all capabilites needed for the post type.", "gd-taxonomies-tools"); ?> <?php _e("Do not change if you are not sure what this is.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Capabilities List", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150"><?php _e("Edit Post", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapsedit_post" value="<?php echo isset($cpt["caps"]["edit_post"]) ? $cpt["caps"]["edit_post"] : ""; ?>" name="cpt[caps][edit_post]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Read Post", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapsread_post" value="<?php echo isset($cpt["caps"]["read_post"]) ? $cpt["caps"]["read_post"] : ""; ?>" name="cpt[caps][read_post]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150"><?php _e("Delete Post", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapsdelete_post" value="<?php echo isset($cpt["caps"]["delete_post"]) ? $cpt["caps"]["delete_post"] : ""; ?>" name="cpt[caps][delete_post]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Edit Posts", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapsedit_posts" value="<?php echo isset($cpt["caps"]["edit_posts"]) ? $cpt["caps"]["edit_posts"] : ""; ?>" name="cpt[caps][edit_posts]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150"><?php _e("Edit Others Posts", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapsedit_others_posts" value="<?php echo isset($cpt["caps"]["edit_others_posts"]) ? $cpt["caps"]["edit_others_posts"] : ""; ?>" name="cpt[caps][edit_others_posts]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Publish Posts", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapspublish_posts" value="<?php echo isset($cpt["caps"]["publish_posts"]) ? $cpt["caps"]["publish_posts"] : ""; ?>" name="cpt[caps][publish_posts]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150"><?php _e("Read Private Posts", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapsread_private_posts" value="<?php echo isset($cpt["caps"]["read_private_posts"]) ? $cpt["caps"]["read_private_posts"] : ""; ?>" name="cpt[caps][read_private_posts]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Read", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapsread" value="<?php echo isset($cpt["caps"]["read"]) ? $cpt["caps"]["read"] : ""; ?>" name="cpt[caps][read]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150"><?php _e("Delete Posts", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapsdelete_posts" value="<?php echo isset($cpt["caps"]["delete_posts"]) ? $cpt["caps"]["delete_posts"] : ""; ?>" name="cpt[caps][delete_posts]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Delete Private Posts", "gd-taxonomies-tools"); ?>:</td>
                <td colspan="4">
                    <input type="text" id="cptcapsdelete_private_posts" value="<?php echo isset($cpt["caps"]["delete_private_posts"]) ? $cpt["caps"]["delete_private_posts"] : ""; ?>" name="cpt[caps][delete_private_posts]" class="input-text-middle" />
                </td>
            <tr>
                <td width="150"><?php _e("Delete Published Posts", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapsdelete_published_posts" value="<?php echo isset($cpt["caps"]["delete_published_posts"]) ? $cpt["caps"]["delete_published_posts"] : ""; ?>" name="cpt[caps][delete_published_posts]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Delete Others Posts", "gd-taxonomies-tools"); ?>:</td>
                <td colspan="4">
                    <input type="text" id="cptcapsdelete_others_posts" value="<?php echo isset($cpt["caps"]["delete_others_posts"]) ? $cpt["caps"]["delete_others_posts"] : ""; ?>" name="cpt[caps][delete_others_posts]" class="input-text-middle" />
                </td>
            <tr>
                <td width="150"><?php _e("Edit Private Posts", "gd-taxonomies-tools"); ?>:</td>
                <td>
                    <input type="text" id="cptcapsedit_private_posts" value="<?php echo isset($cpt["caps"]["edit_private_posts"]) ? $cpt["caps"]["edit_private_posts"] : ""; ?>" name="cpt[caps][edit_private_posts]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150"><?php _e("Edit Published Posts", "gd-taxonomies-tools"); ?>:</td>
                <td colspan="4">
                    <input type="text" id="cptcapsedit_published_posts" value="<?php echo isset($cpt["caps"]["edit_published_posts"]) ? $cpt["caps"]["edit_published_posts"] : ""; ?>" name="cpt[caps][edit_published_posts]" class="input-text-middle" />
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <div class="inputbutton"><a href="javascript:capabilities_posttype()"><?php _e("Reset capabailities", "gd-taxonomies-tools"); ?></a></div>
        <div class="gdsr-table-split"></div>
        <?php _e("Do not change any of these if you are not sure what they are. All values must be filled.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<tr><th scope="row"><?php _e("Advanced", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150">
                    <?php _e("Edit Link", "gd-taxonomies-tools"); ?>:
                </td>
                <td>
                    <input type="text" value="<?php echo $cpt["edit_link"]; ?>" name="cpt[edit_link]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150">
                    <?php _e("Rewrite Slug", "gd-taxonomies-tools"); ?>:
                </td>
                <td>
                    <input type="text" value="<?php echo $cpt["rewrite_slug"]; ?>" name="cpt[rewrite_slug]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150">
                    <?php _e("Rewrite With Front", "gd-taxonomies-tools"); ?>:
                </td>
                <td>
                    <select name="cpt[rewrite_front]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["rewrite_front"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["rewrite_front"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td style="width: 20px;"></td>
                <td width="150">
                    <?php _e("Publicly Queryable", "gd-taxonomies-tools"); ?>:
                </td>
                <td>
                    <select name="cpt[publicly_queryable]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["publicly_queryable"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["publicly_queryable"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150">
                    <?php _e("Exclude From Search", "gd-taxonomies-tools"); ?>:
                </td>
                <td>
                    <select name="cpt[exclude_from_search]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["exclude_from_search"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["exclude_from_search"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td style="width: 20px;"></td>
                <td width="150">
                    <?php _e("Can be Exported", "gd-taxonomies-tools"); ?>:
                </td>
                <td>
                    <select name="cpt[can_export]" class="input-text-middle">
                        <option value="yes"<?php echo $cpt["can_export"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $cpt["can_export"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("Changing some of these settings can have undesired effects and can break your website.", "gd-taxonomies-tools"); ?> <?php _e("Do not change this if you are not sure about this. Consult WordPress documentation for more details.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
</tbody></table>
<input type="submit" class="inputbutton" value="<?php _e("Save Custom Post", "gd-taxonomies-tools"); ?>" name="gdtt_savecpt" style="margin-top: 10px;" />

</form>