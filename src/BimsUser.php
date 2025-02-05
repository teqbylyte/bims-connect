<?php

namespace Teqbylyte\BimsConnect;

use Laravel\Socialite\Two\User;

class BimsUser extends User
{
    public string $first_name;

    public string $last_name;

    public ?string $middle_name;

    public string $type;

    public ?object $institution;

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getMiddleName(): string
    {
        return $this->middle_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getInstitutionId(): int
    {
        return $this->institution?->id;
    }

    public function isAcademicStaff(): bool
    {
        return $this->type === 'lecturer';
    }

    public function isNonAcademicStaff(): bool
    {
        return $this->type === 'staff';
    }

    public function isStudent(): bool
    {
        return $this->type === 'student';
    }

    public function isClient(): bool
    {
        return $this->type === 'client';
    }
}