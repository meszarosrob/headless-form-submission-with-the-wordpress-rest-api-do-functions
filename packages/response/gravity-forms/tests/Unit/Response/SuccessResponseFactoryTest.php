<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Tests\Unit\Response;

use HeadlessWpForms\GravityForms\Response\SuccessResponse;
use HeadlessWpForms\GravityForms\Response\SuccessResponseFactory;
use HeadlessWpForms\GravityForms\Tests\TestCase;

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
