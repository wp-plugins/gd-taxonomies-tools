<form method="post" action="">
<div id="gdtt_tabs" class="gdtttabs">
<ul>
    <li><a href="#fragment-1"><span><?php _e("General", "gd-taxonomies-tools"); ?></span></a></li>
    <li><a href="#fragment-2"><span><?php _e("Sitemap", "gd-taxonomies-tools"); ?></span></a></li>
</ul>
<div style="clear: both"></div>
<div id="fragment-1">
<?php include GDTAXTOOLS_PATH."forms/settings/general.php"; ?>
</div>
<div id="fragment-2">
<?php include GDTAXTOOLS_PATH."forms/settings/sitemap.php"; ?>
</div>
</div>

<input type="submit" class="inputbutton" value="<?php _e("Save Settings", "gd-taxonomies-tools"); ?>" name="gdtt_saving" style="margin-top: 10px;" />
</form>
