<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Tests\Unit\Field;

use HeadlessWpForms\ServerlessMockedResponse\Field\BaseField;
use HeadlessWpForms\ServerlessMockedResponse\Tests\TestCase;

readonly final class FieldStub extends BaseField
{
    public function validate(): void
    {
    }
}

// phpcs:ignore PSR1.Classes.ClassDeclaration.MultipleClasses
final class BaseFieldTest extends TestCase
{
    public function testItStoresAndReturnsFieldNameAndValue(): void
    {
        $fieldStub = new FieldStub('some-field', 'Some value');

        $this->assertSame('some-field', $fieldStub->name());
        $this->assertSame('Some value', $fieldStub->value());
    }
}
