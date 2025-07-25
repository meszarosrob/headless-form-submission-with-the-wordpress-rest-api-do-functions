<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\MultiPartFormData;

use HeadlessWpForms\ServerlessMockedResponse\HttpArgs\HttpArgs;
use InvalidArgumentException;

final class MultiPartFormDataFactory
{
    /**
     * @throws InvalidArgumentException
     */
    public function createFromHttpArgs(HttpArgs $httpArgs): MultiPartFormData
    {
        return new MultiPartFormData(
            $this->rawBody($httpArgs),
            $this->boundary($httpArgs),
        );
    }

    /**
     * @throws InvalidArgumentException
     */
    private function boundary(HttpArgs $httpArgs): string
    {
        if (str_starts_with($httpArgs->contentType, 'multipart/form-data') === false) {
            throw new InvalidArgumentException('Invalid content-type.');
        }

        $boundary = explode('boundary=', $httpArgs->contentType)[1] ?? '';

        if ($boundary === '') {
            throw new InvalidArgumentException('Missing boundary in content-type definition.');
        }

        return $boundary;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function rawBody(HttpArgs $httpArgs): string
    {
        if (!$httpArgs->isBase64Encoded) {
            return $httpArgs->body;
        }

        $decodedBody = base64_decode($httpArgs->body, true);

        if ($decodedBody === false) {
            throw new InvalidArgumentException('Body cannot be decoded from base64.');
        }

        return $decodedBody;
    }
}
