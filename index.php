<?php
require __DIR__."/vendor/autoload.php";
$config = require __DIR__.'/config.php';
//
use App\CoderLast\Framework;
use App\CoderLast\Plugins;
//
$bot = new Framework($config['TOKEN']);
$plugins = new Plugins($config['TOKEN']);

$home = [["Hello word!", "Hello word !"]];

$input = $bot->getInput();
if(isset($input->message)){
	$message = $input->message;
	$chat_id = $message->chat->id;
	$text = $message->text;
	$userid	= $message->from->id;
	$name = $message->from->frist_name." ".$message->from->last_name;
    $new_chat_member = $message->new_chat_member;
    $newcmemid = $new_chat_member->id;
    $new_chat_member_first_name = $new_chat_member->first_name;
	$chat_title = $message->chat->title;
	$chat_tip = $message->chat->type;
}

if($text == "/start"){
	$get = $botdata->onerow("SELECT * FROM members WHERE user_id = $userid");
	if(!$get){
		$botdata->query("INSERT INTO members ('user_id','langs') VALUES ('$userid', 'uz')");
	}
	$bot->sendMessage($userid,"CLFramework",[
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