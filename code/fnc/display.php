<?php

class gdttWalker_TermsDropdown extends Walker_CategoryDropdown {
    function get_url($tax, $term) {
        $url = get_term_link($term, $tax);
        $home = home_url()."/";
        $url = substr($url, strlen($home));
        return $url;
    }

    function start_el(&$output, $term, $depth, $args) {
        $pad = str_repeat('&nbsp;', $depth * 3);

        $term_name = apply_filters('list_term_name', $term->name, $term);
        $term_url = $this->get_url($args["taxonomy"], $term);
        $output .= "\t<option class=\"level-$depth\" value=\"".$term_url."\"";
        if ( $term->term_id == $args['selected'] ) $output .= ' selected="selected"';
        $output .= '>';
        $output .= $pad.$term_name;
        if ( $args['show_count'] ) $output .= '&nbsp;&nbsp;('. $term->count .')';
        if ( $args['show_last_update'] ) {
            $format = 'Y-m-d';
            $output .= '&nbsp;&nbsp;' . gmdate($format, $term->last_update_timestamp);
        }
        $output .= "</option>\n";
    }
}

/**
* Display or retrieve the HTML dropdown list of terms for any taxonomy.
*
* @param string|array $args Optional. Override default arguments.
* @return string HTML content only if 'echo' argument is 0.
*/
function gdtt_dropdown_taxonomy_terms( $args = '' ) {
    $defaults = array(
        'show_option_all' => '', 'show_option_none' => '',
        'orderby' => 'id', 'order' => 'ASC',
        'show_last_update' => 0, 'show_count' => 0,
        'hide_empty' => 1, 'child_of' => 0,
        'exclude' => '', 'echo' => 1,
        'selected' => 0, 'hierarchical' => 0,
        'name' => 'cat', 'id' => '',
        'class' => 'postform', 'depth' => 0,
        'tab_index' => 0, 'taxonomy' => 'category',
        'hide_if_empty' => false
    );

    $r = wp_parse_args( $args, $defaults );

    if ( !isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] ) {
        $r['pad_counts'] = true;
    }

    $r['include_last_update_time'] = $r['show_last_update'];
    extract( $r );

    $tab_index_attribute = '';
    if ( (int) $tab_index > 0 ) $tab_index_attribute = " tabindex=\"$tab_index\"";

    $categories = get_terms( $taxonomy, $r );
    $name = esc_attr( $name );
    $class = esc_attr( $class );
    $id = $id ? esc_attr( $id ) : $name;

    if ( ! $r['hide_if_empty'] || ! empty($categories) ) {
        $output = "<select name='$name' id='$id' class='$class' $tab_index_attribute>\n";
    } else {
        $output = '';
    }

    if ( empty($categories) && ! $r['hide_if_empty'] && !empty($show_option_none) ) {
        $show_option_none = apply_filters( 'list_cats', $show_option_none );
        $output .= "\t<option value='-1' selected='selected'>$show_option_none</option>\n";
    }

    if ( ! empty( $categories ) ) {
        if ( $show_option_all ) {
            $show_option_all = apply_filters( 'list_cats', $show_option_all );
            $selected = ( '0' === strval($r['selected']) ) ? " selected='selected'" : '';
            $output .= "\t<option value='0'$selected>$show_option_all</option>\n";
        }

        if ( $show_option_none ) {
            $show_option_none = apply_filters( 'list_cats', $show_option_none );
            $selected = ( '-1' === strval($r['selected']) ) ? " selected='selected'" : '';
            $output .= "\t<option value='-1'$selected>$show_option_none</option>\n";
        }

        if ( $hierarchical ) $depth = $r['depth'];
        else $depth = -1;

        $r["walker"] = new gdttWalker_TermsDropdown();
        $output .= walk_category_dropdown_tree( $categories, $depth, $r );
    }

    if ( !$r['hide_if_empty'] || ! empty($categories) ) $output .= "</select>\n";
    $output = apply_filters( 'wp_dropdown_terms_'.$taxonomy, $output );
    if ( $echo ) echo $output;
    return $output;
}

?>