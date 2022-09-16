<?php

namespace App\Helpers;

class Datas
{

    /**
     * Retorna data no formato Br dd/mm/YYYY.
     */
    public static function formatoBr($date, $construcaoTemporal = false){
        $dateReturn = date("d/m/Y", strtotime($date));
        if($construcaoTemporal){
            $hoje = date("Y-m-d");
            $ontem = date('Y-m-d', strtotime("-1 day", strtotime($hoje)));
            $amanha = date('Y-m-d', strtotime("+1 day", strtotime($hoje)));
            if($date == $hoje){
                $dateReturn = "Hoje";
            }elseif($date == $ontem){
                $dateReturn = "Ontem";
            }elseif($date == $amanha){
                $dateReturn = "Amanhã";
            }
        }
        return $dateReturn;
    }




}