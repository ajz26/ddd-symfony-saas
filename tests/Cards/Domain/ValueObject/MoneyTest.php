<?php

namespace App\Tests\Cards\Domain\ValueObject;

use App\Cards\Domain\Entity\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testCreateMoneyFromFloat(): void
    {
        $money = Money::fromFloat(10.99);
        $this->assertEquals(10.99, $money->getAmount());
        $this->assertEquals('EUR', $money->getCurrency());
    }

    public function testCannotCreateNegativeMoney(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Money::fromFloat(-10.99);
    }

    public function testMoneyAddition(): void
    {
        $money1 = Money::fromFloat(10.00);
        $money2 = Money::fromFloat(20.00);
        $result = $money1->add($money2);
        
        $this->assertEquals(30.00, $result->getAmount());
    }

    public function testCannotAddDifferentCurrencies(): void
    {
        $money1 = Money::fromFloat(10.00, 'EUR');
        $money2 = Money::fromFloat(20.00, 'USD');
        
        $this->expectException(\InvalidArgumentException::class);
        $money1->add($money2);
    }
} 