<?php

namespace App\Session;

use App\Repository\AdministratorRepository;
use App\Repository\CustomerRepository;

class PHPSession implements SessionInterface
{

    /**
     * Ensure session start
     *
     * @return void
     */
    private function ensureStarted()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    /**
     * Get a information with sessions
     *
     * @param  string $key
     * @param  mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $this->ensureStarted();
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }
        return $default;
    }

    /**
     * Set a information with sessions
     *
     * @param  string $key
     * @param  mixed $value
     *
     * @return void
     */
    public function set(string $key, $value): void
    {
        $this->ensureStarted();
        $_SESSION[$key] = $value;
    }

    /**
     * Delete a information in sessions
     *
     * @param  string $key
     *
     * @return void
     */
    public function delete(string $key): void
    {
        $this->ensureStarted();
        unset($_SESSION[$key]);
    }

    public function isLog(): bool
    {
        if (empty($this->get('email')) && empty($this->get('password'))) {
            return false;
        }

        $customer = (new CustomerRepository())->selectOne([
            'email' => $this->get('email')
        ]);

        if ($this->get('password') == $customer->getPassword()) {
            return true;
        }

        return false;
    }

    public function isAdmin(): bool
    {
        if (!$this->isLog()) {
            return false;
        }

        $admin = (new AdministratorRepository())->select(
            ['email' => $this->get('email')]
        );
        return (!empty($admin));
    }
}
