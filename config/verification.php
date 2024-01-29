<?php

return [
    // default => no verification
    // email => email verification ON
    // cvt => email verification with custom token
    // otp => otp verification
//    'mode' => 'email',
    'mode' => 'otp',

    'otp_provider' => 'vonage',
];
