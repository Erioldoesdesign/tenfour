<?php
namespace TenFour\Http\Transformers;

use League\Fractal\TransformerAbstract;

class SubscriptionTransformer extends TransformerAbstract
{
    public function transform(array $subscription)
    {
        return $subscription;
    }

}
