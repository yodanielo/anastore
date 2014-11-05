<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Form {
    public $key;
    public function getInstance(){
        return new Form();
    }
    public function beginForm($name,$key){
        $cad='';
        $this->key=$key;
        $cad.='<form name="'+$name+'" id="'.$name.'" method="POST">';
    }
    public function endForm(){
        $cad='';
        $cad.='</form>';
    }
    public function addText($label,$name){
        $cad='';
        $cad.='<div class="ffila">';
        $cad.='<label for="'.$name.'">'.$label.'</label>';
        $cad.='<div class="zonacontrol"><input type="text" name="'.$name.'" id="'.$this->key.$name.'"/></div>';
        $cad.='</div>';
    }
    public function addCombo($label,$name,$campos){
        $cad='';
        $cad.='<div class="ffila">';
        $cad.='<label for="'.$name.'">'.$label.'</label>';
        $cad.='<div class="zonacontrol"><select name="'.$name.'" id="'.$this->key.$name.'">';
        if(count($campos)>0){
            foreach ($campos as $key => $value) {
                $cad+='<option value="'+$key+'">'+$value+'</option>';
            }
        }
        $cad.='</select></div>';
        $cad.='</div>';
    }
    public function addDatepicker($label,$name){
        $cad='';
        $cad.='<div class="ffila">';
        $cad.='<label for="'.$name.'">'.$label.'</label>';
        $cad.='<div class="zonacontrol"><input class="padatepicker" type="text" name="'.$name.'" id="'.$this->key.$name.'"/></div>';
        $cad.='</div>';
    }
    public function addUpload($label,$name){
        $cad='';
        $cad.='<div class="ffila">';
        $cad.='<label for="'.$name.'">'.$label.'</label>';
        $cad.='<div class="zonacontrol"><input class="pafile" name="'.$name.'" id="'.$this->key.$name.'" type="file" /></div>';
        $cad.='</div>';
    }
}

?>
