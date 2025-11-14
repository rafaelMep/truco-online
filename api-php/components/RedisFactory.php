<?php

namespace app\components;

use Predis\Client;

final class RedisFactory
{
    public static function client(): Client
    {
        $scheme   = getenv('REDIS_SCHEME') ?: 'tls';
        $host     = getenv('REDIS_HOST');
        $port     = (int)(getenv('REDIS_PORT') ?: 6379);
        $username = getenv('REDIS_USERNAME') ?: 'default';
        $password = getenv('REDIS_PASSWORD');

        if ($host && $password) {
            return new Client([
                'scheme'   => $scheme,
                'host'     => $host,
                'port'     => $port,
                'username' => $username,
                'password' => $password,
            ]);
        }

        throw new \RuntimeException('Config do Redis ausente. Defina REDIS_* ou REDIS_DSN no .env.');
    }
}
