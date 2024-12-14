<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\Firebase;
use App\Models\User\UserDevice;
use App\Events\OrderNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderNotification $event): void
    {
        //
        $order = $event->order;
        $type = $event->type;
        $user = $event->user;

        if($type == 'newOrder') {

            $drivers = User::delegate()->where(function ($q) {
                $q->whereNull('socket_id');
                $q->orWhere('status', 1);
            })->pluck('id')->toArray();
            $arTokens = UserDevice::whereIn('user_id', $drivers)
                ->pluck('fcm_token')->whereLang('ar')->toArray();
            $enTokens = UserDevice::whereIn('user_id', $drivers)
                ->pluck('fcm_token')->whereLang('ar')->toArray();
            $title = 'receiveNewOrder';
            $message = 'receiveNewOrderMessage';
        } else {

            $arTokens = UserDevice::whereIn('user_id', $user->id)
                ->pluck('fcm_token')->whereLang('ar')->toArray();

            $enTokens = UserDevice::whereIn('user_id', $user->id)
                ->pluck('fcm_token')->whereLang('ar')->toArray();

            if($type == 'acceptedOrder') {
                $title = 'acceptedOrder';
                $message = 'acceptedOrderMessage';

            } elseif($type == 'confirmOrder') {
                $title = 'confirmOrder';
                $message = 'confirmOrderMessage';
            } elseif($type == 'startedOrder') {
                $title = 'startedOrder';
                $message = 'startedOrderMessage';
            }

        }
        if(! empty($arTokens) &&  count($arTokens) > 0) {
            Firebase::send(
                $arTokens,
                __('messages.'.$title, [], 'ar'),
                __('messages.'.$message, [], 'ar'),
                [
                     'type' => $type,
                     'data' => $order
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
                     'data' => $order
                 ]
            );
        }
    }
}
