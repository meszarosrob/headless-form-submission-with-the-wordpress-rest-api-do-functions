<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Unit\Field;

use HeadlessWpForms\ContactForm7\Field\AnyEmailField;
use HeadlessWpForms\ContactForm7\Tests\TestCase;
use HeadlessWpForms\ServerlessMockedResponse\Field\InvalidField;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;

final class AnyEmailFieldTest extends TestCase
{
    #[DataProvider('invalidValueProvider')]
    public function testItThrowsExceptionOnInvalidValue(string $value, string $exceptionMessage): void
    {
        $this->expectException(InvalidField::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new AnyEmailField('some-field', $value))->validate();
    }

    public function testNoExceptionAreThrownForValidValue(): void
    {
        $this->expectNotToPerformAssertions();

        (new AnyEmailField('some-field', 'john@johndoe.com'))->validate();
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
            'Some value',
            'The e-mail address entered is invalid.',
        ];
    }
}
