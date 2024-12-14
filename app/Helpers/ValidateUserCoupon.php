<?php

namespace App\Helpers;


use App\Models\Ordering\Order;
class ValidateUserCoupon
{
    public static function validate($coupon, $device_uuid)
    {
        $user = auth()->user();
        $result = [];
        $valid = 0;
        $error = 0;
        $status = 'FAILED'; //'status' => 'SUCCESS',
        $ordersByCouponAndUser = Order::where('coupon_id', $coupon->id)
            ->where('user_id', $user->id)
            ->count();
        if ($ordersByCouponAndUser >= $coupon->maximum_usage) {
            $result = ['valid' => $valid,'status' => $status,'error' => 1, 'message' => __('messages.CouponUsageReachMax')];
        } elseif ($coupon->active == 0) {
            $result = ['valid' => $valid,'status' => $status,'error' => 1, 'message' => __('messages.CouponNotActive')];
        } elseif ($coupon->started_at != null && date('Y-m-d') < $coupon->started_at) {
            $result = ['valid' => $valid,'status' => $status,'error' => 1, 'message' => __('messages.CouponNotStarted')];
        } elseif ($coupon->expired_at != null && date('Y-m-d') > $coupon->expired_at) {
            $result = ['valid' => $valid,'status' => $status,'error' => 1, 'message' => __('messages.CouponExpired')];
        } else {
            $result = ['valid' => 1,'status' => 'SUCCESS','error' => 0, 'message' => __('messages.CouponNotStarted')];
        }

        return $result;
    }
}
