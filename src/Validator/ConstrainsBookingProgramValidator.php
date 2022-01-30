<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstrainsBookingProgramValidator extends ConstraintValidator
{
    private static $cnp;
    private static $program_id;
    /**
     * @inheritDoc
     */
    public function validate(mixed $value, Constraint $constraint)
    {

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!isset($other)) {
            $other = $value;
        }

        $a = $value;
        // TODO: Implement validate() method.
    }
}