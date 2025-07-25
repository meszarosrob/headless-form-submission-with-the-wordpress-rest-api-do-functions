<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Tests\Architecture;

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
                Selector::inNamespace('HeadlessWpForms\GravityForms\Field'),
            )
            ->shouldExtend()
            ->classes(
                Selector::classname(BaseField::class),
            );
    }
}
