<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Tests\Unit\HttpArgs;

use HeadlessWpForms\ServerlessMockedResponse\HttpArgs\HttpArgsFactory;
use HeadlessWpForms\ServerlessMockedResponse\Tests\TestCase;

final class HttpArgsFactoryTest extends TestCase
{
    public function testItSetsDefaultWhenEventInputIsEmpty(): void
    {
        $httpArgs = (new HttpArgsFactory())->createFromDOEventInput([]);

        $this->assertSame('', $httpArgs->body);
        $this->assertSame('', $httpArgs->contentType);
        $this->assertFalse($httpArgs->isBase64Encoded);
    }

    public function testItExtractsBodyContentTypeIsBase64EncodedFromEventInput(): void
    {
        $httpArgs = (new HttpArgsFactory())->createFromDOEventInput([
            'http' => [
                'body' => 'Some value',
                'headers' => [
                    'content-type' => 'multipart/form-data',
                ],
                'isBase64Encoded' => true,
            ],
        ]);

        $this->assertSame('Some value', $httpArgs->body);
        $this->assertSame('multipart/form-data', $httpArgs->contentType);
        $this->assertTrue($httpArgs->isBase64Encoded);
    }
}
