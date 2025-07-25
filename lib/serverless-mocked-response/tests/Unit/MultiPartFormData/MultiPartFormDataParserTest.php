<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Tests\Unit\MultiPartFormData;

use HeadlessWpForms\ServerlessMockedResponse\MultiPartFormData\MultiPartFormData;
use HeadlessWpForms\ServerlessMockedResponse\MultiPartFormData\MultiPartFormDataParser;
use HeadlessWpForms\ServerlessMockedResponse\Tests\TestCase;

final class MultiPartFormDataParserTest extends TestCase
{
    public function testItParsesMultipartFormDataBodyInputIntoKeyValuePairs(): void
    {
        $boundary = '----WebKitFormBoundaryaAwLqEoB91LHgQIT';
        $body = $this->normalizeMultipartFormDataBody(
            <<<BODY
                --{$boundary}
                Content-Disposition: form-data; name="input_1"
                
                value_1
                --{$boundary}
                Content-Disposition: form-data; name="input_2"
                
                
                --{$boundary}
                Content-Disposition: form-data; name="input_3"
                
                value_3
                --{$boundary}--
                BODY,
        );

        $this->assertSame(
            [
                'input_1' => 'value_1',
                'input_2' => '',
                'input_3' => 'value_3',
            ],
            (new MultiPartFormDataParser())->parse(
                new MultiPartFormData(
                    $body,
                    $boundary,
                ),
            ),
        );
    }
}
