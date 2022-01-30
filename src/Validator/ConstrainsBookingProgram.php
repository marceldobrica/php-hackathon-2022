<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ConstrainsBookingProgram extends Constraint
{
    public $message = 'The training program you are about to book should not overlap other training programs you have booked';
}