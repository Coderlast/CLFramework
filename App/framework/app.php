<?php

class App{

    public function parser($url){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            
        $html = curl_exec($curl);
        return $html;
    }

    public function convert_seconds($seconds){
        $dt1 = new DateTime("@0");
        $dt2 = new DateTime("@$seconds");
        return $dt1->diff($dt2)->format('%i:%s');
    }


    public function sizeconvert($size){
        $size = round($size / 1024, 2);
        if($size > 1024000){
            $size = round($size / 1024000, 2).' GB';
        }elseif($size > 1024){
            $size = round($size / 1024, 2).' MB';
        }else{ $size = $size.' KB';  }
        return $size;
    }

    public function genrate($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }    
}