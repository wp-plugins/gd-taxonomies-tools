<?php

/*
Plugin Name: GD Taxonomies Tools
Plugin URI: http://www.dev4press.com/plugins/gd-taxonomies-tools/
Description: GD Taxonomies Tools is plugin for management and tools collection for working with custom taxonomies.
Version: 0.5.0
Author: Milan Petrovic
Author URI: http://www.dev4press.com/
*/

require_once(dirname(__FILE__)."/config.php");
require_once(dirname(__FILE__)."/code/defaults.php");
require_once(dirname(__FILE__)."/code/functions.php");
require_once(dirname(__FILE__)."/code/database.php");
require_once(dirname(__FILE__)."/code/classes.php");
require_once(dirname(__FILE__)."/code/widget.php");
require_once(dirname(__FILE__)."/gdragon/gd_debug.php");
require_once(dirname(__FILE__)."/gdragon/gd_functions.php");
require_once(dirname(__FILE__)."/gdragon/gd_wordpress.php");
require_once(dirname(__FILE__)."/widgets/gdtt-terms-cloud.php");
require_once(dirname(__FILE__)."/widgets/gdtt-terms-list.php");

if (!class_exists('GDTaxonomiesTools')) {
    class GDTaxonomiesTools {
        var $plugin_url;
        var $plugin_path;
        var $wp_version;
        var $admin_plugin;
        var $admin_plugin_page;
        var $script;
        var $taxes;
        var $errors;
        var $edit_tax;
        var $o;
        var $t;
        var $l;

        var $on_tinymce_main = false;

        var $default_options;
        var $default_taxonomies;

        function GDTaxonomiesTools() {
            $gdd = new GDTTDefaults();
            $this->default_options = $gdd->default_options;
            $this->default_taxonomies = $gdd->default_taxonomies;
            define('GDTAXONOMIESTOOLS_INSTALLED', $this->default_options["version"]." ".$this->default_options["status"]);

            $this->plugin_path_url();
            $this->install_plugin();
            $this->features_testing();
            $this->actions_filters();

            define('GDTAXTOOLS_DEBUG_ACTIVE', true);
        }

        function features_testing() {
            $this->on_tinymce_main = file_exists($this->plugin_path.'tinymce3/gdtt_main/');
        }

        function get($setting) {
            return $this->o[$setting];
        }

        function install_plugin() {
            global $wp_version;
            $this->wp_version = substr(str_replace('.', '', $wp_version), 0, 2);

            $this->o = get_option('gd-taxonomy-tools');
            $this->t = get_option('gd-taxonomy-tools-tax');

            if (!is_array($this->o)) {
                update_option('gd-taxonomy-tools', $this->default_options);
                $this->o = get_option('gd-taxonomy-tools');
            } else if ($this->o["build"] < $this->default_options["build"] ||
                $this->o["edition"] != $this->default_options["edition"]) {
                $this->o = gdFunctionsGDTT::upgrade_settings($this->o, $this->default_options);

                $this->o["version"] = $this->default_options["version"];
                $this->o["date"] = $this->default_options["date"];
                $this->o["status"] = $this->default_options["status"];
                $this->o["build"] = $this->default_options["build"];
                $this->o["edition"] = $this->default_options["edition"];

                update_option('gd-taxonomy-tools', $this->o);
            }

            if (!is_array($this->t)) {
                $this->t = array();

                update_option('gd-taxonomy-tools-tax', $this->t);
            }

            $this->taxes = array();
            foreach ($this->t as $tx) {
                $this->taxes[] = $tx["name"];
            }

            $this->script = $_SERVER["PHP_SELF"];
            $this->script = end(explode("/", $this->script));
        }

        function plugin_path_url() {
            $this->plugin_url = WP_PLUGIN_URL.'/gd-taxonomies-tools/';
            $this->plugin_path = dirname(__FILE__)."/";

            define('GDTAXTOOLS_URL', $this->plugin_url);
            define('GDTAXTOOLS_PATH', $this->plugin_path);
        }

        function get_defaults_count() {
            return $this->default_taxonomies["wp".$this->wp_version];
        }

        function actions_filters() {
            add_action('init', array(&$this, 'init'));
            add_action('init', array(&$this, 'register_taxonomies'), 1000);

            add_action('admin_init', array(&$this, 'admin_init'));
            add_action('admin_menu', array(&$this, 'admin_menu'));
            add_action('admin_head', array(&$this, 'admin_head'));
            add_action('widgets_init', array(&$this, 'widgets_init'));

            add_filter('plugin_row_meta', array(&$this, 'plugin_links'),10, 2);
            add_filter('plugin_action_links', array(&$this, 'plugin_actions'), 10, 2);
            add_action('after_plugin_row', array(&$this,'plugin_check_version'), 10, 2);

            if ($this->o["sitemap_expand"] == 1)
                add_action("sm_buildmap", array(&$this, 'expand_sitemap'));
        }

        function widgets_init() {
            register_widget("gdttTermsCloud");
            register_widget("gdttTermsList");
        }

        function expand_sitemap() {
            global $sxml, $wp_taxonomies;
            if (class_exists("GoogleSitemapGenerator")) {
                $sxml = &GoogleSitemapGenerator::GetInstance();
                if ($sxml != null)  {
                    $taxs = array_slice($wp_taxonomies, $this->get_defaults_count());
                    foreach ($taxs as $tax => $info) {
                        $terms = get_terms($tax, array());
                        foreach ($terms as $term) {
                            $sxml->AddUrl(get_term_link($term, $tax), time(), "daily", 0.6);
                        }
                    }
                }
            }
        }

	function plugin_links($links, $file) {
            static $this_plugin;
            if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
            if ($file == $this_plugin){
                $links[] = '<a href="admin.php?page=gdtaxtools-settings">' . __("Settings", "gd-taxonomies-tools") . '</a>';
                if ($this->o["edition"] == "free") $links[] = '<a style="color: #cc0000; font-weight: bold;" href="http://www.dev4press.com/donate/">' . __("Donate", "gd-taxonomies-tools") . '</a>';
            }
            return $links;
	}

        function plugin_actions($links, $file) {
            static $this_plugin;
            if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

            if ($file == $this_plugin){
                $settings_link = '<a href="admin.php?page=gdtaxtools-taxs">'.__("Taxonomies", "gd-taxonomies-tools").'</a>';
                array_unshift($links, $settings_link);
            }
            return $links;
        }

        function plugin_check_version($file, $plugin_data) {
            static $this_plugin;
            if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

            if ($file == $this_plugin){
                $current = get_transient('update_plugins');
                if (!isset($current->response[$file])) return false;

                $url = gdFunctionsGDTT::get_update_url($this->o, get_option('home'));
                $update = wp_remote_fopen($url);
                if ($update != "") {
                    echo '<td colspan="3" class="gdr-plugin-update"><div class="gdr-plugin-update-message">';
                    echo $update;
                    echo '</div></td>';
                }
            }
        }

        function init() {
            $this->l = get_locale();
            if(!empty($this->l)) {
                $moFile = dirname(__FILE__)."/languages/gd-taxonomies-tools-".$this->l.".mo";
                if (@file_exists($moFile) && is_readable($moFile)) load_textdomain('gd-taxonomies-tools', $moFile);
            }
        }

        function register_taxonomies() {
            foreach ($this->t as $tax) {
                if (isset($tax["active"])) {
                    $options = array("hierarchical" => $tax["hierarchy"] == 1, "label" => $tax["label"]);
                    if ($tax["rewrite"] == "yes_custom") $options["rewrite"] = $tax["rewrite_custom"];
                    else $options["rewrite"] = $tax["rewrite"] == "yes_name";
                    if ($tax["query"] == "yes_custom") $options["query_var"] = $tax["query_custom"];
                    else $options["query_var"] = $tax["query"] == "yes_name";
                    register_taxonomy($tax["name"], $tax["domain"], $options);
                }
            }
        }

        function is_term_valid($term, $check_empty = false) {
            if (trim($term) == "" && $check_empty) return false;
            return strtolower($term) == sanitize_title_with_dashes($term);
        }

        function is_taxonomy_valid($tax_name) {
            global $wp_taxonomies;
            $tax_names = array_keys($wp_taxonomies);
            return !in_array(strtolower($tax_name), $tax_names);
        }

        function find_taxonomy($id) {
            $found = array();
            for ($i = 0; $i < count($this->t); $i++) {
                if ($this->t[$i]["id"] == $id) {
                    $found = $this->t[$i];
                    break;
                }
            }

            return $found;
        }

        function prepare_inactive() {
            $found = array();
            foreach ($this->t as $tax) if (!isset($tax["active"])) $found[] = new gdtt_Taxonomy($tax);
            return $found;
        }

        function find_taxonomy_pos($id) {
            $found = -1;
            for ($i = 0; $i < count($this->t); $i++) {
                if ($this->t[$i]["id"] == $id) {
                    $found = $i;
                    break;
                }
            }

            return $found;
        }

        function admin_init() {
            if (isset($_GET["page"])) {
                if (substr($_GET["page"], 0, 10) == "gdtaxtools" || $_GET["page"] == "gd-taxonomies-tools/gd-taxonomies-tools.php") {
                    $this->admin_plugin = true;
                    $this->admin_plugin_page = substr($_GET["page"], 11);
                }
            }

            wp_enqueue_script('jquery');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('jquery-ui-datepicker', $this->plugin_url.'js/jquery-ui-datepicker-17.js');
            wp_enqueue_style('jquery-ui-datepicker', $this->plugin_url.'css/jquery_ui17.css');

            $this->init_operations();
            $this->settings_operations();
            $this->init_savetax();
        }

        function init_operations() {
            if (isset($_GET["action"])) {
                $action = $_GET["action"];
                $url = remove_query_arg("action");
                switch ($action) {
                    case "deltax":
                        $id = $this->find_taxonomy_pos($_GET["tid"]);
                        if ($id > -1) {
                            $tax_name = $this->t[$id]["name"];
                            unset($this->t[$id]);
                            $this->t = array_values($this->t);
                            update_option('gd-taxonomy-tools-tax', $this->t);
                            gdttDB::delete_taxonomy_terms($tax_name);
                        }
                        $url = remove_query_arg("tid", $url);
                        wp_redirect($url);
                        exit;
                        break;
                }
            }
        }

        function init_savetax() {
            if (isset($_POST["gdtt_savetax"])) {
                $tax = $_POST["tax"];
                $this->errors = "";

                if (!isset($tax["domain"])) $tax["domain"] = "post";
                if (!isset($tax["rewrite_custom"])) $tax["rewrite_custom"] = "";
                if (!isset($tax["hierarchy"])) $tax["hierarchy"] = "no";

                $tax["label"] = strip_tags($tax["label"]);
                $tax["rewrite_custom"] = sanitize_title_with_dashes($tax["rewrite_custom"]);
                $tax["query_custom"] = sanitize_title_with_dashes($tax["query_custom"]);
                if (!$this->is_term_valid($tax["name"])) $this->errors = "name";
                else {
                    if (trim($tax["label"]) == "") $tax["label"] = $tax["name"];
                    if (trim($tax["rewrite_custom"]) == "") $tax["rewrite_custom"] = $tax["name"];
                    if (trim($tax["query_custom"]) == "") $tax["query_custom"] = $tax["name"];
                }

                if ($tax["id"] == 0) {
                    if (!$this->is_taxonomy_valid($tax["name"])) $this->errors = "name";
                    if ($this->errors == "") {
                        $this->o["tax_internal"]++;
                        $tax["id"] = $this->o["tax_internal"];
                        $this->t[] = $tax;
                        update_option('gd-taxonomy-tools', $this->o);
                        update_option('gd-taxonomy-tools-tax', $this->t);
                    }
                } else {
                    $toedit = $this->t[$tax["id"]];
                    if (isset($tax["rename"]) && $toedit["name"] != $tax["name"]) {
                        if (!$this->is_taxonomy_valid($tax["name"])) $this->errors = "name";
                    }
                    if ($this->errors == "") {
                        $id = $this->find_taxonomy_pos($tax["id"]);
                        if ($id > -1) {
                            $this->t[$id] = $tax;
                            update_option('gd-taxonomy-tools-tax', $this->t);
                        }
                    }
                }

                $this->edit_tax = $tax;
            }
        }

        function settings_operations() {
            if (isset($_POST['gdtt_saving'])) {
                $this->o["delete_taxonomy_db"] = isset($_POST['delete_taxonomy_db']) ? 1 : 0;
                $this->o["sitemap_expand"] = isset($_POST['sitemap_expand']) ? 1 : 0;

                update_option("gd-taxonomy-tools", $this->o);
                wp_redirect(add_query_arg("settings", "saved"));
                exit();
            }
        }

        function admin_menu() {
            add_menu_page('GD TAX Tools', 'GD TAX Tools', 10, __FILE__, array(&$this,"admin_front"), plugins_url('gd-taxonomies-tools/gfx/menu.png'));
            add_submenu_page(__FILE__, 'GD TAX Tools: '.__("Front Page", "gd-taxonomies-tools"), __("Front Page", "gd-taxonomies-tools"), 10, __FILE__, array(&$this,"admin_front"));
            add_submenu_page(__FILE__, 'GD TAX Tools: '.__("Taxonomies", "gd-taxonomies-tools"), __("Taxonomies", "gd-taxonomies-tools"), 10, "gdtaxtools_taxs", array(&$this, "admin_taxs"));
            add_submenu_page(__FILE__, 'GD TAX Tools: '.__("Settings", "gd-taxonomies-tools"), __("Settings", "gd-taxonomies-tools"), 10, "gdtaxtools_settings", array(&$this, "admin_settings"));
        }

        function admin_head() {
            if ($this->admin_plugin) {
                wp_admin_css('css/dashboard');
                echo('<link rel="stylesheet" href="'.$this->plugin_url.'css/admin_main.css" type="text/css" media="screen" />');
                if(!empty($this->l)) {
                    $jsFile = $this->plugin_path.'js/i18n/jquery-ui-datepicker-'.$this->l.'.js';
                    if (@file_exists($jsFile) && is_readable($jsFile)) echo '<script type="text/javascript" src="'.$this->plugin_url.'js/i18n/jquery-ui-datepicker-'.$this->l.'.js"></script>';
                }
                echo('<script type="text/javascript" src="'.$this->plugin_url.'js/taxonomy-tools.js"></script>');
                include($this->plugin_path."/code/js.php");
            }

            if ($this->admin_plugin_page != "settings") {
                include($this->plugin_path."code/corrections.php");
            }

            if ($this->script == "widgets.php" || $this->script == "themes.php" || $this->script == "plugins.php") {
                echo('<link rel="stylesheet" href="'.$this->plugin_url.'css/admin_widgets.css" type="text/css" media="screen" />');
            }
        }

        function admin_front() {
            $options = $this->o;
            $gdtttax = $this->taxes;
            $errors = $this->errors;

            include($this->plugin_path.'forms/shared/front.header.php');
            include($this->plugin_path.'forms/admin/front.php');
            include($this->plugin_path.'forms/shared/all.footer.php');
        }

        function admin_settings() {
            $options = $this->o;
            $gdtttax = $this->taxes;
            $errors = $this->errors;

            $page_title = __("Settings", "gd-taxonomies-tools");
            include($this->plugin_path.'forms/shared/all.header.php');
            include($this->plugin_path.'forms/admin/settings.php');
            include($this->plugin_path.'forms/shared/all.footer.php');
        }

        function admin_tools() {
            $options = $this->o;
            $gdtttax = $this->taxes;
            $errors = $this->errors;

            $page_title = __("Tools", "gd-taxonomies-tools");
            include($this->plugin_path.'forms/shared/all.header.php');
            include($this->plugin_path.'forms/admin/tools.php');
            include($this->plugin_path.'forms/shared/all.footer.php');
        }

        function admin_taxs() {
            $options = $this->o;
            $wpv = $this->wp_version;
            $gdtttax = $this->taxes;
            $gdtxall = $this->t;
            $errors = $this->errors;
            $action = isset($_GET["action"]) ? $_GET["action"] : "list";

            if ($action == "list") {
                $page_title = __("Taxonomies", "gd-taxonomies-tools");
                include($this->plugin_path.'forms/shared/all.header.php');
                include($this->plugin_path.'forms/admin/taxonomies.php');
            } else if ($action == "addnew") {
                $page_title = __("Add new Taxonomy", "gd-taxonomies-tools");
                include($this->plugin_path.'forms/shared/all.header.php');
                include($this->plugin_path.'forms/admin/taxonomy.add.php');
            } else if ($action == "edit") {
                $page_title = __("Edit Taxonomy", "gd-taxonomies-tools");
                $tax = $this->find_taxonomy($_GET["tid"]);
                include($this->plugin_path.'forms/shared/all.header.php');
                include($this->plugin_path.'forms/admin/taxonomy.edit.php');
            }

            include($this->plugin_path.'forms/shared/all.footer.php');
        }
    }

    $gdtt_debug = new gdDebugGDTT(GDTAXTOOLS_LOG_PATH);
    $gdtt = new GDTaxonomiesTools();

    function wp_gdtt_dump($msg, $obj, $block = "none", $mode = "a+") {
        if (GDTAXTOOLS_DEBUG_ACTIVE) {
            global $gdtt_debug;
            $gdtt_debug->dump($msg, $obj, $block, $mode);
        }
    }

    include(GDTAXTOOLS_PATH."code/fnc/general.php");

}

?>