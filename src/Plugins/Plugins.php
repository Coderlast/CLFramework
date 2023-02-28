<?php

/**
 * CoderLast
 * 19.05.2020
 * micro Plugin
 * Class Plugins
 */
namespace App\CoderLast;


/**
 * Class Plugins
 * @package App\CoderLast\Plugins
 */
class Plugins{
   
    public function getMethod(){
        return [
            'Keyboards',
            'setSession',
            'getSession',
            'stopSession',
            'inlineKeyboard'
        ];
    }
    /**
     * @param array $array
     * @param bool $resize
     * @return false|string
     */
    public function Keyboards(array $array, $resize = true)
    {

        return json_encode(['resize_keyboard' => $resize,'keyboard' => $array,]);;
    }
    public function setSession($session, $id)
    {
        file_put_contents("log/$id.session", "$session");
    }
    public function getSession($id)
    {
        $a = file_get_contents("log/$id.session");
        return $a;
    }
    public function stopSession($id)
    {
        $a = unlink("log/$id.session");
        return $a;
    }
    public function inlineKeyboard(array $data){
        return json_encode([
            'inline_keyboard'=>$data
        ]);
    }


}
