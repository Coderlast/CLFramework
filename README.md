<h1 align="center">CLFramework - CFL micro framework</h1>

[![API](https://img.shields.io/badge/CLFramework-Mart%2007%2C%202021-36ade1.svg)](https://core.telegram.org/bots/api)
![PHP](https://img.shields.io/badge/php-%3E%3D7.4-8892bf.svg)
![CURL](https://img.shields.io/badge/cURL-required-green.svg)

<div align="center">
	<a href="https://core.telegram.org/bots/api">Telegram Bot API</a> <b>Foydalanish uchun yaratilgan</b> 
	<br>
	<a href="https://telegram.me/Clframework">Telegram Support Group</a> <b>Telegram Guruximiz</b> 
</div>

## Ornatish - composer orqali
```
composer require coderlast/clframewrok
```
Composer orqali yuklaganigizdan kegin 

*config.php* - fayl yarating va uni ichiga 👇
```
$config = [
	"TOKEN"=>"bot tokeni",
];
```
#### Kegin index.php fayl yaratamiz va uni ichiga 👇

```php
<?php
require "vendor/autoload.php";
require "config.php";

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
```


Copyright © 2020 CoderLast
