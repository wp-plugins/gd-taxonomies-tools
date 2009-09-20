<?php

class gdttDB {
    function delete_taxonomy_terms($tax) {
        global $wpdb, $table_prefix;

        $sql = sprintf("delete %s from %sterm_taxonomy tt left join %sterm_relationships tr  on tt.term_taxonomy_id = tr.term_taxonomy_id where tt.taxonomy = '%s'", 
            gdFunctionsGDTT::mysql_pre_4_1() ? sprintf("%sterm_taxonomy, %sterm_relationships", $table_prefix, $table_prefix) : "tt, tr", $table_prefix, $table_prefix, $tax);
        $wpdb->query($sql);
    }
}

?>