<?php

namespace App\Models;

class PayMode
{
    public  static function getList(){
        return ['Mercado Pago','Depósito'];
    }
}
