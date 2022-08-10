<?php

declare(strict_types=1);

namespace App\User;

class User
{
    private string $name;
    private string $email;
    private string $password;
    private string $gender;
    private int $age;
    private string $location;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $gender
     * @param integer $age
     */
    public function __construct(string $name, string $email, string $password, string $gender, int $age)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->gender = $gender;
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getLocation(): string
    {
        return $this->location;
    }
}
