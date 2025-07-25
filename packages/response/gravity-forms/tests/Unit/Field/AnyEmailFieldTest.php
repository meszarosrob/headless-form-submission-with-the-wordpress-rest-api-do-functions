<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Tests\Unit\Field;

use HeadlessWpForms\GravityForms\Field\AnyEmailField;
use HeadlessWpForms\GravityForms\Tests\TestCase;
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
            'This field is required.',
        ];

        yield [
            'Some value',
            'The email address entered is invalid, please check the formatting (e.g email@domain.com).',
        ];
    }
}
