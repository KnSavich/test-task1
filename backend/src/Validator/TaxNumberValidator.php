<?php

namespace App\Validator;

use App\Repository\CountryRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TaxNumberValidator extends ConstraintValidator
{
    private CountryRepository $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof TaxNumber) {
            throw new UnexpectedTypeException($constraint, TaxNumber::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value) || !preg_match('/^\w{2}\d{9}$/i', $value)) {
            $this->context
                ->buildViolation(TaxNumber::ERROR_INVALID_TAX_NUMBER)
                ->addViolation();
            return;
        }

        $countryCode = mb_substr(trim($value), 0, 2);
        $country = $this->countryRepository->findOneBy(['countryCode' => mb_strtoupper($countryCode)]);

        if (!$country) {
            $this->context
                ->buildViolation(TaxNumber::ERROR_UNAVAILABLE_COUNTRY)
                ->addViolation();
        }
    }
}