<?php

return [

    'tables' => [
        'fr_pivot' => 'friendships',
        'fr_groups_pivot' => 'user_friendship_groups'
    ],

    'groups' => [
        'conhecidos' => 0,
        'amigos' => 1,
        'familiares' => 2,
        'jogadores' => 3,
    ]

];