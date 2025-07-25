<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Unit\Field;

use HeadlessWpForms\ContactForm7\Field\BeforeSpaceAgeField;
use HeadlessWpForms\ContactForm7\Tests\TestCase;
use HeadlessWpForms\ServerlessMockedResponse\Field\InvalidField;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;

final class BeforeSpaceAgeFieldTest extends TestCase
{
    #[DataProvider('invalidValueProvider')]
    public function testItThrowsExceptionOnInvalidValue(string $value, string $exceptionMessage): void
    {
        $this->expectException(InvalidField::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new BeforeSpaceAgeField('some-field', $value))->validate();
    }

    public function testNoExceptionAreThrownForValidValue(): void
    {
        $this->expectNotToPerformAssertions();

        (new BeforeSpaceAgeField('some-field', '1957-10-04'))->validate();
    }

    /**
     * @return Iterator<(array<string>)>
     */
    public static function invalidValueProvider(): Iterator
    {
        yield [
            '',
            'The field is required.',
        ];

        yield [
            'Not a date',
            'The date entered is invalid.',
        ];

        yield [
            '2000-01-01',
            'The date is after the latest one allowed.',
        ];
    }
}
