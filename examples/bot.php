<?php
require "vendor/autoload.php";

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
}

if ($text == "/start"){
    $bot->sendMessage($chat_id, "Hello World");
}