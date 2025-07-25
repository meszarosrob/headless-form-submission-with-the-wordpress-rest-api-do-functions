<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Architecture;

use HeadlessWpForms\ServerlessMockedResponse\Field\BaseField;
use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final class FieldsExtendsBaseFieldTest
{
    public function testItExtendsBaseField(): Rule
    {
        return PHPat::rule()
            ->classes(
                Selector::inNamespace('HeadlessWpForms\ContactForm7\Field'),
            )
            ->shouldExtend()
            ->classes(
                Selector::classname(BaseField::class),
            );
    }
}
