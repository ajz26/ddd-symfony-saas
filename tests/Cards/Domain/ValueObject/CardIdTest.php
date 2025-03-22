<?php

namespace App\Tests\Cards\Domain\ValueObject;

use App\Cards\Domain\Entity\CardId;
use PHPUnit\Framework\TestCase;

class CardIdTest extends TestCase
{
    public function testCreateFromValidId(): void
    {
        $cardId = CardId::fromInt(1);
        $this->assertEquals(1, $cardId->getValue());
    }

    public function testCannotCreateWithNegativeId(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        CardId::fromInt(-1);
    }

    public function testCannotCreateWithZeroId(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        CardId::fromInt(0);
    }

    public function testEquality(): void
    {
        $cardId1 = CardId::fromInt(1);
        $cardId2 = CardId::fromInt(1);
        $cardId3 = CardId::fromInt(2);
        
        $this->assertTrue($cardId1->equals($cardId2));
        $this->assertFalse($cardId1->equals($cardId3));
    }

    public function testToString(): void
    {
        $cardId = CardId::fromInt(123);
        $this->assertEquals('123', (string) $cardId);
    }
} 