<?php

namespace App\Policies;

use App\Entity\Currency;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicies
{
    use HandlesAuthorization;

    public function view(User $user , Currency $currency)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->is_admin;
    }

//    public function update(User $user , Currency $currency)
//    {
//        return $user->is_admin;
//    }

    public function update(User $user, Currency $currency)
    {
        return $user->getAttribute('is_admin');
    }

    public function delete(User $user , Currency $currency)
    {
        return $user->is_admin;
    }
    
}
