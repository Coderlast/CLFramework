<h1 align="center">CLFramework - CFL micro framework</h1>

<div align="center">

[Telegram Bot API](https://core.telegram.org/bots/api) **Foydalanish uchun yaratilgan** 
</div>



## index.php

```php
<?php
require __DIR__."/vendor/autoload.php";
$config = require __DIR__.'/config.php';

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
```

## Malumotnoma

**SQLite bazada** `members` **table bor** 
<table>
  <tr>
    <th>ID</th>
    <th>user_id</th>
    <th>langs</th>
  </tr>
  <tr>
    <td>1</td>
    <td>936130343</td>
    <td>uz</td>
  </tr>
</table>

# Plugins
## Pluginlar Ro'yhati

            getChatMemberOne
            getChatMemberFull
            Keyboards
            setSession
            getSession
            stopSession
            inlineKeyboard
 
<div align="center"><b>Botlar uchun maxsus yaratilgan pluginlarni ishlatish</b></div>

## Keyboards
```php
<?php
  
  $bot->sendMessage("chat_id","text",['reply_markup'=>$plugins->Keyboards($keyboard)
            ]);

?>
```

## GetChatMemberFull
```php
<?php
  $config = require __DIR__.'/config.php';
  use App\CoderLast\Plugins;
  use App\CoderLast\Framework;
  $bot = new Framework($config['TOKEN']);
  $plugins = new Plugins($config['TOKEN']);
   
  $input = $bot->getInput();
    if(isset($input)){
        $userid = $input->message->from->id;
    }
  $plugins->getChatMemberFull($config['channels'], $userid);

?>
```

## Session
```php
<?php
  $config = require __DIR__.'/config.php';
  use App\CoderLast\Plugins;
  use App\CoderLast\Framework;
  $bot = new Framework($config['TOKEN']);
  $plugins = new Plugins($config['TOKEN']);
   
  $input = $bot->getInput();

    if(isset($input)){
        $userid = $input->message->from->id;
        $text = $input->message->text;
    }
    $session = $plugins->getSession($userid);
    if($text == "/start"){
     $bot->sendMessage($userid, "Ismingizni kiriting");
     $plugins->setSession("ism", $userid);
    }

    if($session == "ism"){
        // bazangizga saxlang kelgan habarni
        $plugins->setSession($userid);
        $bot->sendMessage($userid, 'Ismingiz Saxlandi');
    }

?>
```

Copyright © 2020 CoderLast
