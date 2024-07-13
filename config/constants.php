<?php

return [
    'user' => [
        'role' => [
            'admin' => 'a',
            'member' => 'm'
        ]
    ],

    'peminjaman' => [
        'status' => [
            '0' => 'cancelled',
            '1' => 'requested',
            '2' => 'borrowed',
            '3' => 'declined',
            // deleted, the member / siswa dont need to click 'pengembalian' button
            // '4' => 'returned', 
            '5' => 'vanished',
            '6' => 'accepted',
        ]
    ],
];
