<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\MultiPartFormData;

use Kekos\MultipartFormDataParser\Parser;
use Nyholm\Psr7\Factory\Psr17Factory;

readonly final class MultiPartFormDataParser
{
    private Psr17Factory $psr17Factory;

    public function __construct()
    {
        $this->psr17Factory = new Psr17Factory();
    }

    /**
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function parse(MultiPartFormData $multiPartFormData): array
    {
        return (new Parser(
            $multiPartFormData->body,
            'multipart/form-data; boundary=' . $multiPartFormData->boundary,
            $this->psr17Factory,
            $this->psr17Factory,
        ))->getFormFields();
    }
}
