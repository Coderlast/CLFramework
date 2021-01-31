<?php
require __DIR__."/vendor/autoload.php";

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

if($text == "/start"){
	$bot->sendMessage($userid,"CLFramework - $name",[
		'parse_mode'=>"markdown",
		'reply_markup'=>$plugins->Keyboards($home)
		]);
}

if($text == "Hello word!"){
    $a = $bot->getMethod();
    $bot->sendMessage($chat_id, print_r($a,true));
}
if($text == "Hello word !"){
    $a = $plugins->getMethod();
    $bot->sendMessage($chat_id, print_r($a,true));
}