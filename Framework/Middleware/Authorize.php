<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize
{
    /**
     * Undocumented function
     *
     * @return bool
     */
    public function isAuthenticated()
    {
        return Session::has('user');
    }

    /**
     * Get user role
     * 
     * @return string $userrole
     */
    public function getUserRole()
    {
        return Session::get('user')['role'];
    }

    /**
     * Handle the users request
     * 
     * @param string $role
     * @return bool
     */
    public function handle($role)
    {
        if ($role === 'guest' && $this->isAuthenticated()) {
            return redirect('/');
        } elseif ($role === 'user' && !$this->isAuthenticated()) {
            return redirect('/login');
        } elseif ($role === 'admin' && $role != $this->getUserRole()) {
            return redirect('/');
        }
    }
}
