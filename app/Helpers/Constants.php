<?php

namespace App\Helpers;

final class Constants
{

    public const PERCENT_TYPE = 0;
    public const AMOUNT_TYPE = 1;
    public const FULL_BANNER = 0;
    public const TWO_BANNER = 1;
    public const THREE_BANNER = 2;
    public const SLIDER_BANNER = 3;

    public const VISION_PAGE_TYPE = 0;
    public const MISSION_PAGE_TYPE = 1;
    public const VALUE_PAGE_TYPE  = 2;
    public const ABOUT_PAGE_TYPE = 3;
    public const SUBSCRIBE_PAGE_TYPE= 4;

    public const ORDER_PAY_STATUS_PENDING = 0;
    public const ORDER_PAY_STATUS_ACCEPTED = 1;
    public const ORDER_PAY_STATUS_REJECTED = 2;

    public const ORDER_PAY_METHOD_CASH =1;
    public const ORDER_PAY_METHOD_PAYFORT =0;

    public const ORDER_STATUS_PENDING = 1;
    public const ORDER_STATUS_ACCEPTED = 2;
    public const ORDER_STATUS_REJECTED = 3;
    public const ORDER_STATUS_DELIVERED = 4;
    public const ORDER_STATUS_CANCELED = 5;
    public const PENDING_REQUEST = 0;
    public const IN_REVIEW_REQUEST = 1;
    public const CONTACTED_REQUEST = 2;
    public const CLOSED_REQUEST = 3;

    public const QUESTION_TYPE = 0;
    public const CLIENT_TYPE = 2;
    public const FEATURE_TYPE= 1;

    public const ARTICLE_TAG_TYPE= 0;
    public const PRODUCT_TAG_TYPE= 1;

    public function getConstant($const_name)
    {
        return constant('self::' . $const_name);
    }
}
