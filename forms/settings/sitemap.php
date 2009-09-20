<table class="form-table"><tbody>
<tr><th scope="row"><?php _e("Rebuild", "gd-taxonomies-tools"); ?></th>
    <td>
        <input type="checkbox" name="sitemap_expand" id="sitemap_expand"<?php if ($options["sitemap_expand"] == 1) echo " checked"; ?> /><label style="margin-left: 5px;" for="sitemap_expand"><?php _e("Add custom taxonomies terms URL's to sitemap file.", "gd-taxonomies-tools"); ?></label>
        <div class="gdsr-table-split"></div>
        <?php _e("This option requires XML Sitemap Generator plugin. Once the sitemap is generated, new terms URL's will be added to it.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
</tbody></table>
