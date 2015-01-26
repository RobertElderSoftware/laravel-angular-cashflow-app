<?php

class CashflowEvent extends Eloquent {
 
    public function user(){
        return $this->belongsTo('User');
    }
}

?>
