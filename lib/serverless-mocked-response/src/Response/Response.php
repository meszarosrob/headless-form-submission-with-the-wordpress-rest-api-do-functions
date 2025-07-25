<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Response;

interface Response
{
    /**
     * @return array<string, mixed>
     */
    public function data(): array;
}
