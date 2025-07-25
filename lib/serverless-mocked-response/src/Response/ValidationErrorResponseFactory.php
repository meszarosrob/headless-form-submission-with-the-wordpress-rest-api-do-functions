<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Response;

interface ValidationErrorResponseFactory
{
    /**
     * @param array<string, string> $inputErrors
     */
    public function create(array $inputErrors): Response;
}
