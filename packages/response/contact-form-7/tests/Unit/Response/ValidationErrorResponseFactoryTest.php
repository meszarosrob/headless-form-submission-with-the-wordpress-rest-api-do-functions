<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Unit\Response;

use HeadlessWpForms\ContactForm7\Response\ValidationErrorResponse;
use HeadlessWpForms\ContactForm7\Response\ValidationErrorResponseFactory;
use HeadlessWpForms\ContactForm7\Tests\TestCase;

final class ValidationErrorResponseFactoryTest extends TestCase
{
    public function testFactoryCreatesTheSpecificImplementation(): void
    {
        $this->assertInstanceOf(
            ValidationErrorResponse::class,
            (new ValidationErrorResponseFactory())->create([]),
        );
    }
}
