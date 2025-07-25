<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\MultiPartFormData;

readonly final class MultiPartFormData
{
    public function __construct(
        public string $body,
        public string $boundary,
    ) {
    }
}
