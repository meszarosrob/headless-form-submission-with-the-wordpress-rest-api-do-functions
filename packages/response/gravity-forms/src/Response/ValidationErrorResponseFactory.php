<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Response;

// phpcs:ignore Generic.Files.LineLength.TooLong
use HeadlessWpForms\ServerlessMockedResponse\Response\ValidationErrorResponseFactory as ValidationErrorResponseFactoryInterface;

final class ValidationErrorResponseFactory implements ValidationErrorResponseFactoryInterface
{
    public function create(array $inputErrors): ValidationErrorResponse
    {
        return new ValidationErrorResponse($inputErrors);
    }
}
