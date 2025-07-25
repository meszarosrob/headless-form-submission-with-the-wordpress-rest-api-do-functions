<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Unit\Response;

use HeadlessWpForms\ContactForm7\Response\SuccessResponse;
use HeadlessWpForms\ContactForm7\Response\SuccessResponseFactory;
use HeadlessWpForms\ContactForm7\Tests\TestCase;

final class SuccessResponseFactoryTest extends TestCase
{
    public function testFactoryCreatesTheSpecificImplementation(): void
    {
        $this->assertInstanceOf(
            SuccessResponse::class,
            (new SuccessResponseFactory())->create(),
        );
    }
}
