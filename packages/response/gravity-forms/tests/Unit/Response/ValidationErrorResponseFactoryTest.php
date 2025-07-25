<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Tests\Unit\Response;

use HeadlessWpForms\GravityForms\Response\ValidationErrorResponse;
use HeadlessWpForms\GravityForms\Response\ValidationErrorResponseFactory;
use HeadlessWpForms\GravityForms\Tests\TestCase;

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
