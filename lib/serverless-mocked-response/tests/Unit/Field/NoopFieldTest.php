<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Tests\Unit\Field;

use HeadlessWpForms\ServerlessMockedResponse\Field\NoopField;
use HeadlessWpForms\ServerlessMockedResponse\Tests\TestCase;

final class NoopFieldTest extends TestCase
{
    public function testItDoesNothingDuringValidation(): void
    {
        $this->expectNotToPerformAssertions();

        (new NoopField('some-field', 'Some value'))->validate();
    }
}
