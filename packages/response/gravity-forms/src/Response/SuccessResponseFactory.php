<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Response;

use HeadlessWpForms\ServerlessMockedResponse\Response\SuccessResponseFactory as SuccessResponseFactoryInterface;

final class SuccessResponseFactory implements SuccessResponseFactoryInterface
{
    public function create(): SuccessResponse
    {
        return new SuccessResponse();
    }
}
