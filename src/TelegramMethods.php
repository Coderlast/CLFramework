<?php

/**
 * CoderLast
 * 19.05.2020
 * micro TelegramMethods
 */
namespace App\CoderLast;
/**
 * Class TelegramMethods
 * @package App\TelegramMethods
 */
class TelegramMethods{

    private $token;
    private $ch;

    /**
     * Framework constructor.
     * @param $t
     */
    public function __construct($token){
        $this->token = $token;
        $this->ch = curl_init();
    }
    public function getMethod(){
        return [
            'getInput',
            'leaveChat',
            'getChat',
            'getPrivateLink',
            'getChatMembersCount',
            'deleteMessage',
            'restrictChatMember',
            'fowardMessage',
            'sendMessage',
            'sendPhoto',
            'sendDocument',
            'sendAudio',
            'sendContact',
            'sendChatAction',
            'editMessage'
        ];
    }
    /**
     * @param $method
     * @return bool|string
     * @param $params
     * @return bool/array
     */
    public function bot($method,$params=[]){
        $url = "https://api.telegram.org/bot".$this->token."/".$method;
        curl_setopt($this->ch,CURLOPT_URL,$url);
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS,$params);
        $res = curl_exec($this->ch);
        if(curl_error($this->ch)){
            var_dump(curl_error($this->ch));
        }else{  
            return json_decode($res);  
        }  
    }

    /**
     * @return mixed
     */
    public function getInput(){
        return json_decode(file_get_contents('php://input'));
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function leaveChat($id){
        return $this->bot('leaveChat', [
            'chat_id'=>$id
        ]);
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function getPrivateLink($id){
        return $this->bot('exportChatInviteLink', ['chat_id'=>$id]);
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function getChatMembersCount($id){
        return $this->bot('getChatMembersCount', ['chat_id'=>$id]);
    }

    /**
     * @param $id
     * @param array $params
     * @return bool|string
     */
    public function getChat($id, $params=[]){
        return $this->bot('getChat', array_merge([
            'chat_id'=>$id,
        ],$params));
    }

    /**
     * @param $id
     * @param $msg_id
     * @return bool|string
     */
    public function deleteMessage($id, $msg_id){
        return $this->bot('deleteMessage', [
           'chat_id' => $id,
           'message_id' => $msg_id,
        ]);
    }

    /**
     * @param $chatid
     * @param $text
     * @param $msg_id
     * @param array $params
     * @return bool|string
     */
    public function editMessage($id, $text, $msg_id, $params = []){
        return $this->bot('editMessageText', array_merge([
            'chat_id'=>$id,
            'text' => $text,
            'message_id'=>$msg_id
        ], $params));
    }

    /**
     * @param $chat_id
     * @param $user_id
     * @param array $params
     * @return bool|string
     */
    public function restrictChatMember($chat_id, $user_id, $params = []){
        return $this->bot('restrictChatMember', array_merge([
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ], $params));
    }

    /**
     * @param $chat_id
     * @param $from_chat_id
     * @param $msg_id
     * @param array $params
     * @return bool|string
     */
    public function fowardMessage($chat_id, $from_chat_id, $msg_id, $params = []){
        return $this->bot('forwardMessage', array_merge([
            'chat_id' => $chat_id,
            'from_chat_id' => $from_chat_id,
            'message_id' => $msg_id
        ], $params));
    }

    /**
     * @param $id
     * @param $text
     * @param array $params
     * @return bool|string
     */
    public function sendMessage($chatid, $text, $params=[]){
        return $this->bot('sendMessage',array_merge([
            'chat_id'=>$chatid,
            'text' => $text,
        ],$params));
    }

    /**
     * @param $chat_id
     * @param $photo
     * @param string $caption
     * @param array $params
     * @return bool|string
     */
    
    public function sendPhoto($chat_id, $photo, $caption = '', $params = []){
        return $this->bot('sendPhoto', array_merge([
            'chat_id'=>$chat_id,
            'photo' => $photo,
            'caption'=>$caption
        ], $params));
    }

    /**
     * @param $chat_id
     * @param $document
     * @param string $caption
     * @param array $params
     * @return bool|string
     */
    public function sendDocument($chat_id, $document, $caption = '', $params = []){
        return $this->bot('sendDocument', array_merge([
            'chat_id'=>$chat_id,
            'document' => $document,
            'caption'=>$caption
        ], $params));
    }


    /**
     * @param $chat_id
     * @param $audio
     * @param string $caption
     * @param array $params
     * @return bool|string
     */
    public function sendAudio($chat_id, $audio, $caption = '', $params = []){
        return $this->bot('sendAudio', array_merge([
            'chat_id'=>$chat_id,
            'photo' => $audio,
            'caption'=>$caption
        ], $params));
    }

    /**
     * @param $id
     * @param $action
     * @return bool|string
     */
    public function sendChatAction($id, $action){
        return $this->bot('sendChatAction', [
            'chat_id' => $id,
            'action' => $action,
        ]);
    }

    /**
     * @param $chat_id
     * @param $phone_number
     * @param $first_name
     * @param array $params
     * @return bool|string
     */
    public function sendContact($chat_id, $phone_number, $first_name, $params = []){
        return $this->bot('sendContact', array_merge([
            'chat_id' => $chat_id,
            'phone_number' => $phone_number,
            'first_name' => $first_name
        ], $params));
    }
    

}