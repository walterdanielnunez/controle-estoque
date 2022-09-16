<?php

namespace App\Helpers;

class Formatador
{
    
        /**
         * Formata float (monetário) para inserir no banco (In view: {!! Formatador::floatToDb('1.123,60') !!})
         * @return float
         */
        public static function floatToDb($val){
            $val = (empty($val)) ? 0.00 : $val;
            $val = str_replace(",", ".", $val);
            $decimalSep1 = substr($val, -3, 1);
            $decimalSep2 = substr($val, -2, 1);

            if($decimalSep1 == "."){
                $val = str_replace(".", "", $val);
                $novo = substr($val, 0, strlen($val)-2).".".substr($val, -2);
            }elseif($decimalSep2 == "."){
                $val = str_replace(".", "", $val);
                $novo = substr($val, 0, strlen($val)-1).".".substr($val, -1);
            }else{
                $novo = str_replace(".", "", $val);
            }
            return $novo;
        }




        /**
         * Float em formato BR Reais. Ex: 1.050,75
         * @return string
         */
        public static function brCurrency($val){
            $val = (float)$val;
            return number_format($val, 2, ',', '.');
        }


    
}