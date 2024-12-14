<?php

namespace App\GraphQL\Mutations\Promotion;

use App\Helpers\ValidateUserCoupon;
use App\Models\Promotion\Coupon;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ValidateUserOnCoupon
{
    private $status = 'FAILED';
    private $valid = 0;
    private $result = ['valid'=> 0,'error' => 0, 'message' => ''];

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->__constructor($args);
    }

    protected function __constructor($args)
    {
        $data = null;
        $coupon_code = $args['coupon_code'];
        $user = auth()->user();
        $device_uuid = \Request::header('device_uuid');

        $coupon = Coupon::where('code', $coupon_code)
            ->publish()
            ->first();

        if (!empty($coupon)) {
            $validateUserCoupon = ValidateUserCoupon::validate($coupon, $device_uuid);
            $this->valid = $validateUserCoupon['valid'];

            if ($validateUserCoupon['valid'] == 0) {
                $this->result = $validateUserCoupon['result'];
            } else {
                $this->valid = 1;
                $this->status = 'SUCCESS';
                $this->result = ['status' => $this->status,'valid'=>  $this->valid,'error' => 0, 'message' => __('messages.CouponIsAvailable')];

            }
        } else {

            $this->result = ['status' => $this->status,'valid'=>  $this->valid,'error' => 1, 'message' => __('messages.CouponNotFound')];
        }

        return $this->result;
    }
}
