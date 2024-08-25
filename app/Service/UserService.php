<?php

namespace App\Service;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{

    /**
     * @param array $data
     * @return mixed
     */
    public function createUser(array $data)
    {
       return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ],201);
    }
}
