<?php

declare(strict_types=1);

namespace App\Tests\Functional\Money;

use Component\Money\Bridge\Factory\MoneyAmountFactory;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Component\Money\Bridge\Factory\MoneyAmountFactory
 */
final class MoneyAmountFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_outputs_formatted_number_with_digits_after_comma(): void
    {
        $usd = new Money(10099, new Currency('USD'));
        self::assertSame('100.99', MoneyAmountFactory::amount($usd));

        $jod = new Money(10999, new Currency('JOD'));
        self::assertSame('10.999', MoneyAmountFactory::amount($jod));
    }
}
