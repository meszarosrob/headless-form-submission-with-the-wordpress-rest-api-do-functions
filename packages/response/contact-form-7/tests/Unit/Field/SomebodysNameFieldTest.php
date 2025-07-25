<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Unit\Field;

use HeadlessWpForms\ContactForm7\Field\SomebodysNameField;
use HeadlessWpForms\ContactForm7\Tests\TestCase;
use HeadlessWpForms\ServerlessMockedResponse\Field\InvalidField;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;

final class SomebodysNameFieldTest extends TestCase
{
    #[DataProvider('invalidValueProvider')]
    public function testItThrowsExceptionOnInvalidValue(string $value, string $exceptionMessage): void
    {
        $this->expectException(InvalidField::class);
        $this->expectExceptionMessage($exceptionMessage);

        (new SomebodysNameField('some-field', $value))->validate();
    }

    public function testNoExceptionAreThrownForValidValue(): void
    {
        $this->expectNotToPerformAssertions();

        (new SomebodysNameField('some-field', 'John Doe'))->validate();
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
    }
}
