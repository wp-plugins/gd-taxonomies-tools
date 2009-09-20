<script type="text/javascript">
function areYouSure() {
    return confirm("<?php _e("Are you sure? Operation is not reversible.", "gd-taxonomies-tools"); ?>");
}

jQuery(document).ready(function() {
    jQuery("#gdtt_tabs").tabs({fx: {height: "toggle"}});
});

function validate_tax_form() {
    var errors = new Array();
    if (jQuery("#taxname").val() == "") errors[errors.length] = "<?php _e("Name", "gd-taxonomies-tools"); ?>";
    if (jQuery("#taxlabel").val() == "") errors[errors.length] = "<?php _e("Label", "gd-taxonomies-tools"); ?>";
    if (errors.length > 0) {
        alert("<?php _e("Some fields must be filled. Check this: ", "gd-taxonomies-tools"); ?>" + errors.join(", "));
        return false;
    } else return true;
}
</script>
