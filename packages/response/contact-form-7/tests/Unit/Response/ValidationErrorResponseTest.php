<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Unit\Response;

use HeadlessWpForms\ContactForm7\Response\ValidationErrorResponse;
use HeadlessWpForms\ContactForm7\Tests\TestCase;

final class ValidationErrorResponseTest extends TestCase
{
    public function testValidationErrorResponseMatchesPredefinedPayload(): void
    {
        $this->assertSame(
            [
                'into' => '#',
                'invalid_fields' => [],
                'message' => 'One or more fields have an error. Please check and try again.',
                'posted_data_hash' => '',
                'status' => 'validation_failed',
            ],
            (new ValidationErrorResponse([]))->data(),
        );
    }

    public function testValidationErrorResponseContainsInvalidFieldsBasedOnInputErrors(): void
    {
        $this->assertSame(
            [
                [
                    'error_id' => '-ve-any-email',
                    'idref' => null,
                    'into' => 'span.wpcf7-form-control-wrap.any-email',
                    'message' => 'The e-mail address entered is invalid.',
                ],
                [
                    'error_id' => '-ve-somebodys-name',
                    'idref' => null,
                    'into' => 'span.wpcf7-form-control-wrap.somebodys-name',
                    'message' => 'The field is required.',
                ],
            ],
            (new ValidationErrorResponse([
                'any-email' => 'The e-mail address entered is invalid.',
                'somebodys-name' => 'The field is required.',
            ]))->data()['invalid_fields'],
        );
    }
}
