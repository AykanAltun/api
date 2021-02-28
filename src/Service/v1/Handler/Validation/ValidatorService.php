<?php
declare(strict_types=1);

namespace App\Service\v1\Handler\Validation;

use App\Request\RequestInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface as SymfonyValidatorInterface;

class ValidatorService implements ValidatorInterface
{
    private SymfonyValidatorInterface $validator;

    public function __construct(SymfonyValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @inheritDoc
     */
    public function validate(RequestInterface $requestI): void
    {
        $errors = $this->validator->validate($requestI);
        if ($errors->count() > 0) {
            // TODO throw exception
        }
    }
}