<?php

use Yormy\PromocodeLaravel\Domain\Create\Models\TranslatableMailTemplate;
use Yormy\PromocodeLaravel\Domain\Tracking\Models\SentEmail;
use Yormy\PromocodeLaravel\Domain\Tracking\Models\SentEmailLog;
use Yormy\PromocodeLaravel\Models\PromocodeStripe;
use Yormy\PromocodeLaravel\Tests\Models\User;

return [
    'models' => [
        'stripe' => PromocodeStripe::class,
    ],
];


//
//    'default_language' => 'en',
//    'languages' => [
//        'en',
//        'nl',
//    ],
//
//    'models' => [
//        // List here all the models that are notifyables.
//        // if you send notifications to users and admins, list them both
//        'notifiables' => [
//            User::class,
//            //Admin::class,
//        ],
//
//        // set your overrideesfor encryption
//        'sent_email' => SentEmail::class,
//        'sent_email_log' => SentEmailLog::class,
//    ],
//
//    'mail_tracker' => [
//        // do not log the following messages content
//        'prevent_content_logging' => [
//            TranslatableMailTemplate::class,
//        ],
//    ],
//
//    'prevented_content_logging' => '*** CONTENT NOT STORED FOR SECURITY ***',
//
//    'default_layout' => [
//        'html' => 'promocode-laravel::layouts.html.red',
//        'text' => 'promocode-laravel::layouts.text.main',
//    ],
//
//    'unsubscribe_view' => [
//        'invalid_token' => 'promocode-laravel::unsubscribe.invalid',
//        'success' => 'promocode-laravel::unsubscribe.success',
//        'prevented' => 'promocode-laravel::unsubscribe.prevented',
//    ],
//];
