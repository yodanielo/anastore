<?php
class pedidos extends Padre{
    //pedidos atendidos
    function index(){
        /*
        0=pendiente
        1=atendido
        2=cancelado
         */
        $query_result="select * from comprobante where estadopedido=1";
        $id="dgvcomprobante";
        $type=0;
        $ajustes=array();
        $this->doGrid($query_result, $id, $type,$ajustes);
    }
}

?>
