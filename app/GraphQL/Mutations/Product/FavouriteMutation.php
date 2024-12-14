<?php

namespace App\GraphQL\Mutations\Product;

use App\Models\Product\Favourite;
use App\Models\Product\Product;

final class FavouriteMutation
{
    public $error = 0;
    public $message = '';

    public function addOrRemoveFavourite($_, array $args)
    {
        $user = auth()->user();
        //check if cart empty from another stores product
        $product = Product::publish()
            ->where('id', $args['product_id'])->first();
        if( empty($product)){
            //return product not found
            $this->error = 1;
            return [
                'error' => $this->error,
                'status' => 'FAIL',
                'message' => 'item not found'

            ];
        }

        $favouriteCheck = Favourite::whereStatus(1)->where('user_id', $user->id)
            ->where('product_id', $args['product_id'])->first();

        if(! empty($favouriteCheck) ){
            //uppdate status only
            $favouriteCheck->update(['status'=>0]);
            return [
                'error' => $this->error,
                'status' => 'SUCCESS',
                'message' => 'The item has been removed to your favourite list.'

            ];

        }

        Favourite::updateOrCreate([
            'product_id' => $args['product_id'],
            'user_id' => $user->id,
        ],[
            'product_id' => $args['product_id'],
            'user_id' => $user->id,
            'status' => 1
        ]);


        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' => 'The item has been added to your favourite list.'
        ];
    }

}
