<?php

use Faker\Generator as Faker;

$factory->define(\App\PrivateMessage::class, function (Faker $faker) {

    $rnd = mt_rand(1, 2);

    return [
        'sender_id' => $rnd,
        'receiver_id' => $rnd == 1 ? 2 : 1,
        'subject' => $faker->text(155),
        'message' => $faker->text(mt_rand(15, 1000)),
        'read' => mt_rand(0, 1)
    ];
});
