<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\HttpArgs;

/**
 * @phpstan-import-type DOEventInput from \HeadlessWpForms\ServerlessMockedResponse\Type
 */
readonly final class HttpArgsFactory
{
    /**
     * @param DOEventInput $eventInput
     */
    public function createFromDOEventInput(array $eventInput): HttpArgs
    {
        return new HttpArgs(
            $eventInput['http']['body'] ?? '',
            $eventInput['http']['headers']['content-type'] ?? '',
            $eventInput['http']['isBase64Encoded'] ?? false,
        );
    }
}
