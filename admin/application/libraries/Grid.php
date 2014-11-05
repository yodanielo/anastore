<?php

class gridColumna {
    
}

class Grid {

    public function __construct() {
        
    }

    public static function getInstance() {
        return new Grid;
    }

    /**
     * establece la sentencia o los contenidos del grid
     * @param type $this->query_result la fuente de los datos del grid
     * @param type $type el tipo de fuente dle grid
     * 0 = sql
     * 1 = JSON
     * 2 = Array
     */
    public function init($CI, $m_query_result, $m_id = "", $m_type = 0, $m_ajustes_nuevos = array()) {
        $this->query_result = $m_query_result;
        $this->id = $m_id;
        $this->type = $m_type;
        $this->ajustes_nuevos = $m_ajustes_nuevos;
        $this->CI = $CI;
    }

    public function ajax() {

        $db = $this->CI->db;
        switch ($type) {
            case 0://sql
                $this->query_result = "select * from ($this->query_result) t limit " . $_GET["skip"] . "," . $_GET["take"];
                $res = $db->query($this->query_result)->result_array();
                return json_encode($res);
                //$this->loadHTML("contenido",array("contenido"=>  json_encode($res)),"","");
                break;
        }
        //$this->loadHTML("contenido", array("result" => $cad), "", "");
    }

    public function cargarGrid() {
        //si los files es vacio, lo pongo en automatico, si hay llenados, solo pongo los que estan
        //si hay como post un grid, muestro un xml si no hay nada muestro un xml
        $db = $this->CI->db;
        $cad = '';
        //preparar los campos
        $fields = array();
        $auxfila = $db->query("select * from ($this->query_result) t limit 1")->result_array();
        $auxconteo = $db->query("select count(*) as conteo from ($this->query_result) t")->result_array();
        $conteo = $auxconteo[0]["conteo"];
        if (count($auxfila) > 0) {
            $keys = array_keys($auxfila[0]);
            foreach ($keys as $key) {
                $fields[] = array(
                    "field" => $key,
                    "title" => $key
                );
            }
        }
        //preparar los settings
        $parametros = array(
            "dataSource" => array(
                "transport" => array(
                    "read" => array(
                        "url" => $this->CI->router->fetch_class() . "/" . $this->CI->router->fetch_method() . '?tokengrid=' . $this->id,
                        "dataType" => "json"
                    )
                ),
                "schema" => array(
                    "total" => array()
                ),
                "pageSize" => 10,
                "serverPaging" => true,
                "serverFiltering" => true,
                "serverSorting" => true
            ),
            "columns" => $fields,
            "height" => 500,
            "filterable" => false,
            "sortable" => false,
            "pageable" => true
        );
        $fields = array_merge_recursive($fields, $this->ajustes_nuevos);

        //ponerel grid
        $cad = '';
        $cad.='<div class="pa_grid" id="' . $this->id . '"></div>';
        $cad.='<script type="text/javascript">
                        ajustes' . $this->id . '=' . json_encode($parametros) . ';
                        getTotal' . $this->id . '=function(response){
                            return ' . $conteo . ';
                        };
                        ajustes' . $this->id . '["dataSource"]["schema"]["total"]=getTotal' . $this->id . ';
                        $(".pa_grid#' . $this->id . '").kendoGrid(ajustes' . $this->id . ');
                   </script>' . "\n";
        return $cad;
    }

}

?>
