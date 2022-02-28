<?php

namespace App\Validator;

use App\Repository\BookingsRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstrainsBookingProgramValidator extends ConstraintValidator
{
    private static $cnp;
    private static $program;

    /**
     * @var BookingsRepository
     */
    private BookingsRepository $bookingsRepository;

    public function __construct(BookingsRepository $BookingRepository)
    {
        $this->bookingRepository = $BookingRepository;
    }


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
        if (gettype($value) === 'string' ) {
            if (!isset(self::$cnp)) {
                self::$cnp = $value;
            }
            else {
                $this->context->buildViolation($constraint->message)->addViolation();
            }
        }
        if (gettype($value) === 'object' ) {
            if (!isset(self::$program)) {
                self::$program = $value;
            }
            else {
                $this->context->buildViolation($constraint->message)->addViolation();
            }
        }

        if (isset(self::$cnp) && isset(self::$program)) {
            $result = $this->bookingRepository->validateBookingProgram(self::$cnp, self::$program);
            if (isset($result[0]['TOTAL']) && $result[0]['TOTAL']>0) {
                $this->context->buildViolation($constraint->message)->addViolation();
            }

        }

    }
}