<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class xmlparser extends SimpleXMLElement {
    
    public function addCData($string) {
        $dom = dom_import_simplexml($this);
        $cdata = $dom->ownerDocument->createCDATASection($string);
        $dom->appendChild($cdata);
    }

    public function assocArrayToXML($ar) {
        $f = create_function('$f,$c,$a', '
            foreach($a as $k=>$v) {
                if(is_array($v)) {
                    if (!is_numeric($k))$ch=$c->addChild($k);
                    else $ch = $c->addChild("row");
                    $f($f,$ch,$v);
                } else {
                    if (is_numeric($v)){ $c->addChild($k, $v);
                    }else{$n = $c->addChild($k); $n->addCData($v);}
                }
            }');
        $f($f, $this, $ar);
        return $this->asXML();
        
    }

}

/**
 * Description of XmlConverter
 *
 * @author daniel
 */
class Xmlconverter{
    private $obj;
    public function __construct($params) {
        if(is_array($params))
            $this->obj=new xmlparser($params[0]);
        else
            $this->obj=new xmlparser($params);
    }
    public function assocArrayToXML($ar){
        //return $this->obj->assocArrayToXML($ar);
        $xml=new SimpleXMLElement("<table/>");
        foreach ($ar as $fila) {
            $el=$xml->addChild("row");
            foreach ($fila as $key => $value) {
                $el->addChild($key, $value);
            }
        }
        return $xml->asXML();
    }
}

?>
