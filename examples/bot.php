<?php
require "vendor/autoload.php";

use App\CoderLast\TelegramMethods;
use App\CoderLast\Plugins;
//
$bot = new TelegramMethods("YOUR_TELEGRAM_BOT_TOKEN");
$plugins = new Plugins("YOUR_TELEGRAM_BOT_TOKEN");

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