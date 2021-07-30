<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UserFile
{
    const PATH = 'users.txt';

    public function __construct()
    {
        $this->filename = Storage::path(self::PATH);
    }

    public function checkCredentials(string $email, string $password)
    {
        $file = fopen($this->filename, 'r');
        $bool = false;
        while ($str = fgets($file)) {
            if (explode(';', trim($str)) == array($email, $password)) {
                $bool = true;
                break;
            }
        }
        fclose($file);
        return $bool;
    }

    public function appendUser(string $email, string $password)
    {
        $data = $email . ';' . $password;
        Storage::append(self::PATH, $data);

        return true;
    }

    public function userExists(string $email)
    {
        $file = fopen($this->filename, 'r');
        $bool = false;
        while ($str = fgets($file)) {
            if (explode(';', trim($str))[0] == $email) {
                $bool = true;
                break;
            }
        }
        fclose($file);
        return $bool;
    }
}
