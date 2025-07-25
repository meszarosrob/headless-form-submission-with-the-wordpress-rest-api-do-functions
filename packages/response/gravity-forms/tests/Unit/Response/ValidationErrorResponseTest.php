<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Tests\Unit\Response;

use HeadlessWpForms\GravityForms\Response\ValidationErrorResponse;
use HeadlessWpForms\GravityForms\Tests\TestCase;

final class ValidationErrorResponseTest extends TestCase
{
    public function testValidationErrorResponseMatchesPredefinedPayload(): void
    {
        $this->assertSame(
            [
                'is_valid' => false,
                'page_number' => 1,
                'source_page_number' => 1,
                'validation_messages' => [],
            ],
            (new ValidationErrorResponse([]))->data(),
        );
    }

    public function testValidationErrorResponseContainsInvalidFieldsBasedOnInputErrors(): void
    {
        $this->assertSame(
            [
                '1' => 'The field is required.',
                // phpcs:ignore Generic.Files.LineLength.TooLong
                '2' => 'The email address entered is invalid, please check the formatting (e.g email@domain.com).',
                '5' => 'The field is required.',
            ],
            (new ValidationErrorResponse([
                'input_1' => 'The field is required.',
                // phpcs:ignore Generic.Files.LineLength.TooLong
                'input_2' => 'The email address entered is invalid, please check the formatting (e.g email@domain.com).',
                'input_5_1' => 'The field is required.',
            ]))->data()['validation_messages'],
        );
    }
}
