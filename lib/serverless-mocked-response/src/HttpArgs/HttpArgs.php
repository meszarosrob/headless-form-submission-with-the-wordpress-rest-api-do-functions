<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\HttpArgs;

readonly final class HttpArgs
{
    public function __construct(
        public string $body,
        public string $contentType,
        public bool $isBase64Encoded,
    ) {
    }
}
