<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Response;

interface SuccessResponseFactory
{
    public function create(): Response;
}
