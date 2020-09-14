<?php

namespace Modules\UserModule\Repository;

use Modules\UserModule\Entities\User;

class UserRepository
{

    public function getAll()
    {
        return User::all();
    }

    public function findById($id)
    {

        return User::find($id);

    }

    public function delete($id)
    {
        $user = $this->findById($id);
        $user->delete();
    }

}
