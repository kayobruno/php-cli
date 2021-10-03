<?php

declare(strict_types=1);

namespace ASPTest\App\Services;

use ASPTest\App\Models\UserDTO;
use ASPTest\App\Repositories\UserRepository;

final class UserService
{
    const MIN_NAME_LENGTH = 2;
    const MAX_NAME_LENGTH = 35;
    const MAX_AGE = 150;
    const EMAIL_RULES = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.(?:tp|er)+$/';

    public function __construct(
        public UserRepository $userRepository
    )
    {}

    /**
     * @throws \Exception
     */
    public function createUser(UserDTO $userDTO): void
    {
        $this->validateParams($userDTO);
        $this->saveUser($userDTO);
    }

    /**
     * @throws \Exception
     */
    private function saveUser(UserDTO $userDTO)
    {
        $hasUser = $this->userRepository->findByEmail($userDTO->email);
        if (false !== $hasUser && null !== $hasUser) {
            throw new \Exception('User already exists in database!');
        }

        $this->userRepository->save($userDTO);
    }

    /**
     * @throws \Exception
     */
    private function validateParams(UserDTO $userDTO): void
    {
        $this->validateNameAndLastName($userDTO->name, $userDTO->lastName);
        $this->validateEmail($userDTO->email);
        if (null !== $userDTO->age) {
            $this->validateAge((int) $userDTO->age);
        }
    }

    /**
     * @throws \Exception
     */
    private function validateNameAndLastName(string $name, string $lastName): void
    {
        $nameLength = strlen($name);
        $lastNameLength = strlen($lastName);

        if ($nameLength < self::MIN_NAME_LENGTH || $nameLength > self::MAX_NAME_LENGTH) {
            throw new \Exception('The name length is invalid!');
        }

        if ($lastNameLength < self::MIN_NAME_LENGTH || $lastNameLength > self::MAX_NAME_LENGTH) {
            throw new \Exception('The last name length is invalid!');
        }
    }

    /**
     * @throws \Exception
     */
    private function validateEmail(string $email): void
    {
        if (!preg_match(self::EMAIL_RULES, $email)) {
            throw new \Exception('Email is invalid!');
        }
    }

    /**
     * @throws \Exception
     */
    private function validateAge(int $age): void
    {
        if ($age < 0 || $age > self::MAX_AGE) {
            throw new \Exception('Age is invalid!');
        }
    }
}