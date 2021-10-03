<?php

declare(strict_types=1);

namespace ASPTest\App\Repositories;

use ASPTest\App\Models\UserDTO;
use ASPTest\App\Contracts\Persistence;

class UserRepository
{
    public function __construct(
        private Persistence $persistence
    )
    {}

    public function save(UserDTO $userDTO): void
    {
        $this->persistence->persist($userDTO);
    }

    public function findByEmail(string $email)
    {
        return $this->persistence->retrieve('email', $email);
    }
}