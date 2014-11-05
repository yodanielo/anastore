<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends Padre {

    //ventas
    public function index() {
        $this->loadHTML("ventas", array(
            "scripts" => array(
                "highcharts.js"
            )
        ));
    }

    public function ventasDiarias() {
        $db = $this->db;
        $sql = "select convert(fechacomprobante,date) as fecha,sum(cantidad*precioUnitario) as montototal from comprobante a
                    inner join detallecomprobante b on a.idcomprobante=b.idcomprobante
                    where estadopedido<>2
                    group by fechacomprobante
                    having convert(fechacomprobante,date) >='" . mysql_escape_string($_POST["fecha1"]) . "' and convert(fechacomprobante,date)<='" . mysql_escape_string($_POST["fecha2"]) . "'";
        $res = $db->query($sql)->result_array();
        $ejes = array();
        foreach ($res as $value) {
            $ejes["ejex"][] = $value["fecha"];
            $ejes["ejey"][] = $value["montototal"];
        }
        echo json_encode($ejes);
    }

    public function productos() {
        $db = $this->db;
        $sql="select a.nombre_es as name,count(*) as y from producto a 
                inner join detallecomprobante b on a.idproducto=b.idproducto
                inner join comprobante c on b.idcomprobante=c.idcomprobante
                where c.estadopedido<>2 and convert(c.fechacomprobante,date) >='" . mysql_escape_string($_POST["fecha1"]) . "' and convert(c.fechacomprobante,date)<='" . mysql_escape_string($_POST["fecha2"]) . "'
                group by a.nombre_es 
                order by 2 desc limit 10";
        $res = $db->query($sql)->result_array();    
        $ejes = array();
        foreach ($res as $value) {
            $ejes["ejex"][] = $value["name"];
            $ejes["ejey"][] = $value["y"];
        }
        echo json_encode($ejes);
    }

}

?>