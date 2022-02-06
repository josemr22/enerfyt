<?php

namespace App\Models;

class OrderState
{
    public  static function getList(){
        return [
            'in_process'=>["value"=>'En espera',"color"=>'warning'],
            'accepted'=>["value"=>'Aceptado',"color"=>'primary'],
            'rejected'=>["value"=>'Rechazado',"color"=>'danger'],
            'delivered'=>["value"=>'Entregado',"color"=>'success']];
    }
}
