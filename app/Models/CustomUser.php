<?php


namespace App\Models;

use App\Services\Token;
use App\Services\UserFile;

class CustomUser
{
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = hash('sha256', $password);
        $this->userFile = new UserFile();
        $this->token = new Token();
    }

    private function emailExist()
    {
        return $this->userFile->userExists($this->email);
    }

    public function setToken()
    {
        return $this->token->setToken($this->email);
    }

    public function save()
    {
        if (! $this->emailExist())
        {
            (new UserFile())->appendUser($this->email, $this->password);
            return true;
        }
        return false;
    }

    public function checkExistingCredentials()
    {
        return (new UserFile())->checkCredentials($this->email, $this->password);
    }

//    public function isAuthenticated()
//    {
//        return $this->token->checkByEmail($this->email);
//    }
}
