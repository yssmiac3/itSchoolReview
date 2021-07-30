<?php


namespace App\Services;


use Illuminate\Support\Facades\Redis;

class Token
{
    public static function getToken()
    {
        return bin2hex(random_bytes(32));
    }

    public function setToken(string $email)
    {
        if ($this->checkByEmail($email))
        {
            $key = str_replace('laravel_database_', '', Redis::keys(self::strByEmail($email))[0]);
            Redis::del($key);
        }
        $token = self::getToken();
        $key = 'tokens:' . $email . ':' . $token;
        Redis::set($key, $token);
        Redis::expire($key, 3600);
        return $token;
    }

    public function checkByToken(string $token)
    {
        return (bool) Redis::keys('tokens:*:' . $token);
    }

    public function checkByEmail(string $email)
    {
        return Redis::keys(self::strByEmail($email));
    }

    private static function strByEmail(string $email)
    {
        return 'tokens:' . $email . '*';
    }
}
