<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Tests\Unit\Field;

use HeadlessWpForms\GravityForms\Field\FakeTermsField;
use HeadlessWpForms\GravityForms\Tests\TestCase;
use HeadlessWpForms\ServerlessMockedResponse\Field\InvalidField;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;

final class FakeTermsFieldTest extends TestCase
{
    #[DataProvider('invalidValueProvider')]
    public function testItThrowsExceptionOnInvalidValue(string $value, string $exceptionMessage): void
    {
        $this->expectException(InvalidField::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new FakeTermsField('some-field', $value))->validate();
    }

    public function testNoExceptionAreThrownForValidValue(): void
    {
        $this->expectNotToPerformAssertions();

        (new FakeTermsField('some-field', '1'))->validate();
    }

    /**
     * @return Iterator<(array<string>)>
     */
    public static function invalidValueProvider(): Iterator
    {
        yield [
            '',
            'This field is required.',
        ];

        yield [
            'Some value',
            'This field is required.',
        ];

        yield [
            '0',
            'This field is required.',
        ];
    }
}
