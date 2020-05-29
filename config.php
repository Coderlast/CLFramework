<?php
return  [
    // TOKENGA @botFather bergan tokeni kiriting
    'TOKEN'=>'',
    // Admin bo'lovchilarni Royhatini kiriting
    'admins' => ['594966461'],
    /*
    * Channel agar sizga 1 dan ortiq kanalni tekshirish kerak 
    * bo'lsa ularni username yoki idsini kiriing
    */
    'channels'=>['@','@','@'],
    /*
    * agar siz sqlite ishlatmoqchi bo'lsangiz sqlite dep yozing
    * agar siz mysql ishlatmoqchi bo'lsangiz mysql dep yozing
    */
    'db'=>"sqlite",
    // mysql bilan bog'lanishni to'ldiring
    'mysql'=>[
        'host'=>"",
        'dbname'=>"",
        'user'=>"",
        'pass'=>"",
        'charset'=>"utf8mb4"
    ]

];