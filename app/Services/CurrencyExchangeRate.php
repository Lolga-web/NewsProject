<?php

namespace App\Services;

use Swap\Laravel\Facades\Swap;

class CurrencyExchangeRate
{

    public function currencyExchangeRate($currency)
    {
        foreach ($currency as $item){
            $rate[$item] = number_format(Swap::latest($item)->getValue(), 2);
        }
        return $rate;
    }

}