<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class TaxNumber extends Constraint
{
    const ERROR_INVALID_TAX_NUMBER = 'Invalid TAX number!';
    const ERROR_UNAVAILABLE_COUNTRY = 'Sorry, but your country is unavailable in our app now!';
}