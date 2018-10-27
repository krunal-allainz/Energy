<?php

namespace Energy\Repositories;

use Energy\Models\User;

class UserRepository
{
    public function getAllUsers()
    {
        /*  Use Join for Fetch Club Income Data with Club Table */
        return User::all();
    }


}
