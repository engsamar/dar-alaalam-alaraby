<?php

namespace App\GraphQL\Mutations\Feedback;

use App\Mail\FeedbackMail;
use App\Mail\SubmitFeedbackMail;
use App\Models\Setting;
use App\Models\Feedback;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SendFeedback
{
    public $MODEL_Feedback_PREFIEX = 'App\Models\Feedback';

    public $error = 0;
    public $message = '';
    public $orderId = null;
    public $response;

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->__constructor($args);
    }

    protected function __constructor($args)
    {
        $this->error = 0;
        $this->message = '';

        $user = auth()->user();
        $args['user_id'] = $user ? $user['id'] : null;
        $args['name'] = $args['name'] ?? $user['name'];
        $args['email'] = $args['email'] ?? $user['email'];
        $args['mobile'] = $args['mobile'] ?? $user['mobile'];
        $this->response = [];

        $feedback = Feedback::create($args);

        return [
            'error' => $this->error,
            'status' => 'SUCCESS',
            'message' =>'your message sent successfully'
        ];
    }


}