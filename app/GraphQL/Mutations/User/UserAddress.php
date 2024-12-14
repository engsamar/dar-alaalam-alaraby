<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User\Address;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserAddress
{

    public $error = 0;
    public $message = '';
    public $orderId = null;
    public $response;

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->__constructor($args);
    }

    public function store($_, array $args)
    {
        $user = auth()->user();
        $args['user_id'] = $user->id;

        Address::create($args);

        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' =>'address has been successfully added'
        ];
    }

    public function update($_, array $args)
    {
        $user = auth()->user();
        $address = Address::where('id', $args['address_id'])
            ->where('user_id', $user->id)->first();
        if (! empty($address)) {
            $address->update($args);
            return [
                'error' => $this->error,
                'status' => 'SUCCESS',
                'message' =>'address has been successfully updated'
            ];

        } else {
            $this->error =1;
            return [
                'error' => $this->error,
                'status' => 'FAIL',
                'message' =>'address is wrong'
            ];
        }
    }

    public function delete($_, array $args)
    {
        $user = auth()->user();
        $address = Address::where('id', $args['address_id'])
            ->where('user_id', $user->id)->first();

        if(! empty($address) ){
            $address->delete();
            return [
                'error' => $this->error,
                'status' => 'SUCCESS',
                'message' =>'address has been successfully deleted'
            ];
        } else {
            $this->error =1;
            return [
                'error' => $this->error,
                'status' => 'FAIL',
                'message' =>'address is wrong'
            ];
        }

    }


}
