<?php
declare(strict_types=1);


namespace App\Users\Domain\Mapper;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class UserMapper
{
    public function getValidationCollectionCreateUser(): Assert\Collection
    {
        return new Assert\Collection([
            'email' => [
                new Assert\NotBlank(),
                new Assert\Email(),
            ],
            'password' => [
                new Assert\NotBlank(),
                new Assert\PasswordStrength(minScore: PasswordStrength::STRENGTH_WEAK),
            ],
            'name' => [
                new Assert\NotBlank(),
                new Assert\Type('string'),
            ],
            'age' => new Assert\Optional([
                new Assert\NotBlank(),
                new Assert\Type('int'),
                new Assert\GreaterThan(10),
                new Assert\LessThan(100)
            ]),
        ]);
    }

}