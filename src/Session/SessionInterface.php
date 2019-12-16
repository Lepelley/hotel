<?php

namespace App\Session;

interface SessionInterface
{
    /**
     * Get a information with sessions
     *
     * @param  string $key
     * @param  mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * Set a information with sessions
     *
     * @param  string $key
     * @param  mixed $value
     *
     * @return void
     */
    public function set(string $key, $value): void;

    /**
     * Delete a information in sessions
     *
     * @param  string $key
     *
     * @return void
     */
    public function delete(string $key): void;
}
