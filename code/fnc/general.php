<?php

/**
 * Get the taxonomy on the taxonomy term page.
 *
 * @return object Taxonomy or null if not on taxonomy term page
 */
function gdtt_get_taxonomy() {
    if (!is_tax()) return null;
    return get_taxonomy(get_query_var('taxonomy'));
}

/**
 * Get the term on the taxonomy term page.
 *
 * @return object Term or null if not on taxonomy term page
 */
function gdtt_get_term() {
    if (!is_tax()) return null;
    return get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
}

/**
 * Get title for the term.
 *
 * @param bool $with_tax Inlcude taxonomy label as prefix
 * @return string Term title
 */
function gdtt_get_term_title($with_tax = false) {
    if (!is_tax()) return "";
    $term = gdtt_get_term();
    if ($with_tax) {
        $tax = gdtt_get_taxonomy();
        return $tax->label.": ".$term->name;
    } else return $term->name;
}

/**
 * Get description for the term.
 *
 * @return string Term description
 */
function gdtt_get_term_description() {
    if (!is_tax()) return "";
    $term = gdtt_get_term();
    return $term->description;
}

/**
 * Display term title.
 */
function gdtt_term_title() {
    echo gdtt_get_term_title();
}

/**
 * Display term description.
 */
function gdtt_term_description() {
    echo gdtt_get_term_description();
}

/**
 * Filter posts using taxonomy terms.
 *
 * @param array $terms terms to search for in different taxonomies
 * @param string what type of result to generate: count, id, post
 * @return array results mixed
 */
function gdtt_posts_term_filter($terms = array(), $result = "count") {
    $posts = array();

    foreach ($terms as $tax => $term) {
        $t = gdttDB::get_posts_for_term_by($term["by"], $tax, $term["terms"], "ID");

        if (count($t) == 0) return array();
        if (count($posts) > 0) {
            $posts = array_intersect($posts, $t);
            if (count($posts) == 0) return array();
        } else $posts = $t;
    }
    if ($result == "count") return count($posts);
    if ($result == "id") return $posts;
}

?>