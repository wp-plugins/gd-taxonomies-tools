<?php

class gdttTermsList extends gdtt_Widget {
    var $folder_name = "gdtt-terms-list";
    var $defaults = array(
        "title" => "Terms List",
        "taxonomy" => "post_tag",
        "number" => 10,
        "orderby" => "name",
        "order" => "asc",
        "display_count" => 1,
        "display_css" => ""
    );

    function gdttTermsList() {
        $widget_ops = array('classname' => 'widget_gdtt_termslist',
            'description' => __("Display list with taxonomy terms.", "gd-taxonomies-tools"));
        $control_ops = array('width' => 400);
        $this->WP_Widget('gdtttermslist', 'gdTT Terms List', $widget_ops, $control_ops);
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['taxonomy'] = strip_tags(stripslashes($new_instance['taxonomy']));
        $instance['number'] = intval(strip_tags(stripslashes($new_instance['number'])));
        $instance['orderby'] = strip_tags(stripslashes($new_instance['orderby']));
        $instance['order'] = strip_tags(stripslashes($new_instance['order']));
        $instance['display_count'] = isset($new_instance['display_count']) ? 1 : 0;
        $instance['display_css'] = strip_tags(stripslashes($new_instance['display_css']));

        return $instance;
    }

    function results($instance) {
        $instance["echo"] = false;
        $args = array();
        foreach ($instance as $name => $value) {
            if ($name != "title" && 
                $name != "taxonomy" &&
                $name != "display_count") $args[] = $name."=".$value;
        }
        return get_terms($instance["taxonomy"], join("&", $args));
    }

    function render($results, $instance) {
        $render = '<div class="gdtt-widget gdtt-terms-list '.$instance["display_css"].'"><ul>';
        //print_r($results);
        foreach ($results as $r) {
            $render.= '<li>';
            $render.= sprintf('<a href="%s" class="gdtt-url">%s</a>', get_term_link($r, $instance["taxonomy"]), $r->name);
            if ($instance["display_count"] == 1) $render.= sprintf(" (%s %s)", $r->count, $r->count == 1 ? __("post", "gd-taxonomies-tools") : __("posts", "gd-taxonomies-tools"));
            $render.= '</li>';
        }
        $render.= '</ul></div>';
        return $render;
    }

}

?>