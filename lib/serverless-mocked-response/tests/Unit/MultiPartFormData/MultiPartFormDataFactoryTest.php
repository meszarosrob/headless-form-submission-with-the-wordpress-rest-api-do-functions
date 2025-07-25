<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Tests\Unit\MultiPartFormData;

use HeadlessWpForms\ServerlessMockedResponse\HttpArgs\HttpArgsFactory;
use HeadlessWpForms\ServerlessMockedResponse\MultiPartFormData\MultiPartFormDataFactory;
use HeadlessWpForms\ServerlessMockedResponse\Tests\TestCase;
use InvalidArgumentException;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * @phpstan-import-type DOEventInput from \HeadlessWpForms\ServerlessMockedResponse\Type
 */
final class MultiPartFormDataFactoryTest extends TestCase
{
    /**
     * @param DOEventInput $eventInput
     */
    #[DataProvider('invalidEventInputProvider')]
    public function testItThrowsExceptionForInvalidEventInput(array $eventInput, string $exceptionMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new MultiPartFormDataFactory())->createFromHttpArgs(
            (new HttpArgsFactory())->createFromDOEventInput($eventInput),
        );
    }

    public function testItExtractsBodyAndBoundary(): void
    {
        $multiPartFormData = (new MultiPartFormDataFactory())->createFromHttpArgs(
            (new HttpArgsFactory())->createFromDOEventInput([
                'http' => [
                    'body' => 'Some value',
                    'headers' => [
                        'content-type' => 'multipart/form-data; boundary=----WebKitFormBoundaryaAwLqEoB91LHgQIT',
                    ],
                ],
            ]),
        );

        $this->assertSame(
            'Some value',
            $multiPartFormData->body,
        );
        $this->assertSame(
            '----WebKitFormBoundaryaAwLqEoB91LHgQIT',
            $multiPartFormData->boundary,
        );
    }

    public function testItExtractsBodyAndBoundaryFromBase64Encoded(): void
    {
        $multiPartFormData = (new MultiPartFormDataFactory())->createFromHttpArgs(
            (new HttpArgsFactory())->createFromDOEventInput([
                'http' => [
                    'body' => base64_encode('Some value'),
                    'headers' => [
                        'content-type' => 'multipart/form-data; boundary=----WebKitFormBoundaryaAwLqEoB91LHgQIT',
                    ],
                    'isBase64Encoded' => true,
                ],
            ]),
        );

        $this->assertSame(
            'Some value',
            $multiPartFormData->body,
        );
        $this->assertSame(
            '----WebKitFormBoundaryaAwLqEoB91LHgQIT',
            $multiPartFormData->boundary,
        );
    }

    /**
     * @return Iterator<(array{0: DOEventInput, 1: string})>
     */
    public static function invalidEventInputProvider(): Iterator
    {
        yield [
            [
                'http' => [
                    'body' => 'Some value',
                    'headers' => [
                        'content-type' => 'application/json',
                    ],
                ],
            ],
            'Invalid content-type.',
        ];

        yield [
            [
                'http' => [
                    'body' => 'Some value',
                    'headers' => [
                        'content-type' => 'multipart/form-data',
                    ],
                ],
            ],
            'Missing boundary in content-type definition.',
        ];

        yield [
            [
                'http' => [
                    'body' => base64_encode('Some value') . 'ö',
                    'headers' => [
                        'content-type' => 'multipart/form-data; boundary=----WebKitFormBoundaryaAwLqEoB91LHgQIT',
                    ],
                    'isBase64Encoded' => true,
                ],
            ],
            'Body cannot be decoded from base64.',
        ];
    }
}
