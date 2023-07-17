<?php

interface MoneyInterface
{

}

class Money {

    public static function format($value)
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }

}
