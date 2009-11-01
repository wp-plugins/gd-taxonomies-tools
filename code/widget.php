<?php

class gdtt_Widget extends WP_Widget {
    var $folder_name = "";
    var $defaults = array();

    function gdtt_Widget() { }

    function widget($args, $instance) {
        global $gdsr, $userdata;
        extract($args, EXTR_SKIP);

        $results = $this->results($instance);
        if (count($results) == 0 && $instance["hide_empty"] == 1) return;

        echo $before_widget.$before_title.$instance["title"].$after_title;
        echo $this->render($results, $instance);
        echo $after_widget;
    }

    function simple_render($instance = array()) {
        $instance = shortcode_atts($this->defaults, $instance);
        $results = $this->results($instance);
        return $this->render($results, $instance);
    }

    function form($instance) {
        $instance = wp_parse_args((array)$instance, $this->defaults);

        include(GDTAXTOOLS_PATH.'widgets/'.$this->folder_name.'/basic.php');
        include(GDTAXTOOLS_PATH.'widgets/'.$this->folder_name.'/filter.php');
        include(GDTAXTOOLS_PATH.'widgets/'.$this->folder_name.'/display.php');
    }

    function prepare($instance, $results) {
        if (count($results) == 0) return array();
        return $results;
    }

    function update($new_instance, $old_instance) { }

    function results($instance) { }

    function render($results, $instance) { }

    function get_excerpt($instance, $r) {
        $text = trim($r->post_excerpt);

        if ($text == "") {
            $text = str_replace(']]>', ']]&gt;', $r->post_content);
            $text = strip_tags($text);
        }

        $text = gdFunctionsGDTT::trim_to_words($text, $instance["display_excerpt_length"]);
        return $text;
    }
}

?>