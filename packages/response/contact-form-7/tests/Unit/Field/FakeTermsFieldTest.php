<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Unit\Field;

use HeadlessWpForms\ContactForm7\Field\FakeTermsField;
use HeadlessWpForms\ContactForm7\Tests\TestCase;
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
            'You must accept the terms and conditions before sending your message.',
        ];

        yield [
            'Some value',
            'You must accept the terms and conditions before sending your message.',
        ];

        yield [
            '0',
            'You must accept the terms and conditions before sending your message.',
        ];
    }
}
