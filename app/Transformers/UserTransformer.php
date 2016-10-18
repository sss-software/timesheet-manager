<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id'                => $user->id,
            'name'              => $user->name,
            'email'             => $user->email,
            'username'          => $user->username,
            'first_name'        => $user->first_name,
            'last_name'         => $user->last_name,
            'profile_image'     => $user->profile_image,
            'role'              => $user->role,
            'working_hours'     => $user->working_hours,
            'worksheet_count'   => $user->getWorksheetCount(),
        ];
    }
}
