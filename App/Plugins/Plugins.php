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

    private $token;
    private $ch;
    private $buttons;

    /**
     * Plugins constructor.
     * @param $token
     */
    function __construct($token)
    {
        $this->ch = curl_init();
        $this->token = $token;
    }
    public function getMethod(){
        return [
            'getChatMemberOne',
            'getChatMemberFull',
            'Keyboards',
            'setSession',
            'getSession',
            'stopSession',
            'inlineKeyboard'
        ];
    }
    /**
     * @param $method
     * @param array $params
     * @return mixed
     */
    public function bot($method,$params=[])
    {
      $url = "https://api.telegram.org/bot".$this->token."/".$method;

        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS,$params);
        $res = curl_exec($this->ch);
        if(curl_error($this->ch)){
            var_dump(curl_error($this->ch));
        }else{  
            return json_decode($this->ch);
        }  
    }
    /**
     * @param $channel
     * @param $user_id
     * @return bool
     */
    public function getChatMemberOne($channel, $user_id)
    {
        $a = $this->bot("getChatMember", ['chat_id'=>$channel, 'user_id'=>$user_id])->result->status;
        $check = ["member", "creator", "administrator"];

        return array_search($a, $check);
    }
    /**
     * @param array $channels
     * @param $user_id
     * @return bool
     */
    public function getChatMemberFull(array $channels , $user_id)
    {
        $result = ['status' => ''];
        foreach ($channels as $key) {
            $a = $this->bot("getChatMember", ['chat_id'=>$key, 'user_id'=>$user_id])->result->status;
            $check = ["member", "creator", "administrator"];

            if(array_search($a, $check)) {
                $result['status'] = true;
            }

            if(! array_search($a, $check)) {
                $result['status'] = false;
            }

        }

        return $result;
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
