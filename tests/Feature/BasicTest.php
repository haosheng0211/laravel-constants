<?php

namespace HaoSheng\Tests\Constants\Feature;

use ErrorException;
use HaoSheng\Tests\Constants\Stub\ErrorCode;
use HaoSheng\Tests\Constants\TestCase;

/**
 * @internal
 * @coversNothing
 */
class BasicTest extends TestCase
{
    public function testEcho(): void
    {
        /* @phpstan-ignore-next-line */
        $this->assertSame('ECHO', ErrorCode::getEcho(ErrorCode::SHOW_ECHO));
    }

    public function testType(): void
    {
        /* @phpstan-ignore-next-line */
        $this->assertSame('Type disabled', ErrorCode::getType(ErrorCode::TYPE_DISABLE));
    }

    public function testMessage(): void
    {
        /* @phpstan-ignore-next-line */
        $this->assertSame('SHOW ECHO', ErrorCode::getMessage(ErrorCode::SHOW_ECHO));
    }

    public function testNotExistsValue(): void
    {
        $this->expectException(ErrorException::class);
        $this->expectExceptionMessage('No match constant');
        /* @phpstan-ignore-next-line */
        ErrorCode::getMessage(ErrorCode::NO_MESSAGE);
    }

    public function testNotExistsAnnotation(): void
    {
        $this->expectException(ErrorException::class);
        $this->expectExceptionMessage('No match constant');
        /* @phpstan-ignore-next-line */
        ErrorCode::getTest(ErrorCode::NO_MESSAGE);
    }
}
