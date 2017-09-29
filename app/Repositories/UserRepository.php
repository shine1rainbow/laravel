<?php

namespace App\Repositories;

use App\Tables\User;

class UserRepository
{
    /**
     * User Model
     *
     * @var User
     */
    protected $model;

    /**
     * Constructor
     *
     * @param  User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
