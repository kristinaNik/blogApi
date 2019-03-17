<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\User as UserResource;
class UserCollection extends ResourceCollection
{
    /**
     * @param $resource
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function collect($resource)
    {
        return $collects = UserResource::collection($resource);
    }


}
