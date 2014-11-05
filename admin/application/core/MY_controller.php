<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Padre extends CI_controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    protected $params;

    public function __construct() {
        parent::__construct();
        $this->params = array();
    }

    public function debug($a) {
        echo '<pre>';
        print_r($a);
        echo '</pre>';
    }

    public function loadHTML($page, $params = array(), $header = "header", $footer = "footer") {
        if (!$params)
            $params = array();
        $default = array(
            "sitename" => config_item("pagetitle"),
            "sitedescription" => config_item("sitedescription"),
            "author" => config_item("author"),
            "owner" => config_item("owner"),
            "css" => array(
                "bootstrap.css",
                "bootstrap-responsive.css",
                "kendo.common.min.css",
                "kendo.default.min.css"
            ),
            "scripts" => array(
                "https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js",
                //"bootstrap.min.js"
                "kendo.web.min.js"
            )
        );
        $cad = '';
        $params = array_merge_recursive($default, $params);
        if ($header && trim($header) != "") {
            $cad.=$this->load->view($header, array("params" => $params), true);
        }
        $cad.=$this->load->view($page, array("params" => $params), true);
        if ($footer && trim($footer) != "") {
            $cad.=$this->load->view($footer, array("params" => $params), true);
        }
        echo $cad;
    }

    public function require_login() {
        if (!$_SESSION["anasariego"]) {
            //$this->loadHTML("login", array(), "", "");
            redirect("login");
            exit;
        }
    }

    protected function merge($a, $b) {
        if (count($a) > 0) {
            foreach ($a as $key => $r) {
                if (isset($b[$key])) {
                    if (!is_array($a[$key]) || !is_array($b[$key])) {
                        $a[$key] = $b[$key];
                    } else {
                        $a[$key] = $this->merge($a[$key], $b[$key]);
                    }
                }
            }
        }
        if (count($b) > 0) {
            foreach ($b as $key => $r) {
                if (!is_array($a[$key]) || !is_array($b[$key]))
                    $a[$key] = $b[$key];
                else {
                    $a[$key] = $this->merge($a[$key], $b[$key]);
                }
            }
        }
        return $a;
    }

    /* ------------------------------------------------------------------------ */

    public function doGrid($query_result, $id = "", $type = 0, $ajustes_nuevos = array()) {
        $CI = & get_instance();
        $this->load->library("grid");
        $dgv = $this->grid->getInstance();
        $dgv->init($CI, $query_result, $id, $type, $ajustes_nuevos);
        if (isset($_GET["tokengrid"]) && $_GET["tokengrid"] == $id) {
            echo $dgv->ajax();
        } else {
            $this->loadHTML("contenido", array("result" => $dgv->cargarGrid()));
        }


    }

}
