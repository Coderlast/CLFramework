<?php
require "vendor/autoload.php";

//
use App\CoderLast\Framework;
use App\CoderLast\Plugins;
//
$bot = new Framework($config['TOKEN']);
$plugins = new Plugins($config['TOKEN']);

$home = [["Hello word!", "Hello word!"]];

$input = $bot->getInput();
if(isset($input->message)){
	$message = $input->message;
	$chat_id = $message->chat->id;
	$text = $message->text;
	$userid	= $message->from->id;
	$name = $message->from->frist_name." ".$message->from->last_name;
}

switch ($text)
{
    case "/start":
        $bot->sendMessage($userid,"CLFramework - $name",[
            'parse_mode'=>"markdown",
            'reply_markup'=>$plugins->Keyboards($home)
        ]);
    break;
    case "Hello word!":
        $a = $bot->getMethod();
        $bot->sendMessage($chat_id, print_r($a,true));
    break;
    case "Hello word !":
        $a = $plugins->getMethod();
        $bot->sendMessage($chat_id, print_r($a,true));
    break;
}
