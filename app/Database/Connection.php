<?php

namespace App\App\Database;

use Exception;
use \PDO;

class Connection
{
    public function make(array $config)
    {
        $dsn = $this->getDsn($config);
        try {
            return new PDO($dsn, $config['username'], $config['password'], $config['options']);
        } catch (Exception $e) {
            dd($e->getMessage());
            return null;
        }
    }


    /**
     * Create a DSN string from a configuration.
     *
     * Chooses socket or host/port based on the 'unix_socket' config value.
     *
     * @param  array   $config
     * @return string
     */
    public function getDsn(array $config)
    {
        return $this->hasSocket($config)
            ? $this->getSocketDsn($config)
            : $this->getHostDsn($config);
    }

    /**
     * Determine if the given configuration array has a UNIX socket value.
     *
     * @param  array  $config
     * @return bool
     */
    public function hasSocket(array $config)
    {
        return isset($config['unix_socket']) && ! empty($config['unix_socket']);
    }

    /**
     * Get the DSN string for a socket configuration.
     *
     * @param  array  $config
     * @return string
     */
    public function getSocketDsn(array $config)
    {
        return "mysql:unix_socket={$config['unix_socket']};dbname={$config['database']}";
    }

    /**
     * Get the DSN string for a host / port configuration.
     *
     * @param  array  $config
     * @return string
     */
    public function getHostDsn(array $config)
    {
        extract($config, EXTR_SKIP);

        return isset($port)
            ? "mysql:host={$config['host']};port={$port};dbname={$config['database']}"
            : "mysql:host={$config['host']};dbname={$config['database']}";
    }

}
