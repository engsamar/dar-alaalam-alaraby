<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\FcmNotification;
use App\Models\User\UserDevice;
use App\Services\Firebase;

class SendNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FcmNotification  $event
     * @return void
     */
    public function handle(FcmNotification $event)
    {
        //
        $data = $event->data;
        $title = $event->title;
        $message = $event->message;
        $user = $event->user;
        $type = $event->type;

        $user = User::where('id', $user)->first();

        if (!empty($user)) {
            $arTokens = UserDevice::whereIn('user_id', $user)
                ->pluck('fcm_token')->whereLang('ar')->toArray();

            $enTokens = UserDevice::whereIn('user_id', $user)
                ->pluck('fcm_token')->whereLang('ar')->toArray();

            // $order_link = DynamicLink::generate('https://makfy.com/orders/id=' . $order->id);

        }


        if(! empty($arTokens) &&  count($arTokens) > 0) {
            Firebase::send(
                $arTokens,
                __('messages.'.$title, [], 'ar'),
                __('messages.'.$message, [], 'ar'),
                [
                    'type' => $type,
                    'data' => $data
                ]
            );
        }
        if(! empty($enTokens) &&  count($enTokens) > 0) {
            Firebase::send(
                $enTokens,
                __('messages.'.$title, [], 'en'),
                __('messages.'.$message, [], 'en'),
                [
                    'type' => $type,
                    'data' => $data
                ]
            );
        }


    }
}
