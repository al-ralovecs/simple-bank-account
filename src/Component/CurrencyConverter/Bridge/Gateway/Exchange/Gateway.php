<?php

declare(strict_types=1);

namespace Component\CurrencyConverter\Bridge\Gateway\Exchange;

use Component\Gateway\Exception\InvalidRequestException;
use Component\Gateway\Gateway\AbstractGetGateway;
use Component\Gateway\Operator\RequestInterface;
use Component\Gateway\Response\Transformer\ClientResponseTransformerInterface;
use Component\Http\Operator\HttpClientInterface;
use Component\Http\Uri\Uri;

/**
 * @method Response request(Request $request)
 */
final readonly class Gateway extends AbstractGetGateway
{
    public function __construct(
        HttpClientInterface $client,
        ClientResponseTransformerInterface $clientResponseTransformer,
        private string $apikey,
    ) {
        parent::__construct($client, $clientResponseTransformer);
    }

    protected function uri(RequestInterface $request): Uri
    {
        if (!$request instanceof Request) {
            throw new InvalidRequestException(Request::class, get_class($request));
        }

        return new Uri(
            '/v1/latest',
            [
                'apikey' => $this->apikey,
                'base_currency' => $request->baseCurrency()->getCode(),
                'currencies' => $request->counterCurrency()->getCode(),
            ],
        );
    }

    /**
     * @return array<string, string>
     */
    protected function headers(RequestInterface $request): array
    {
        return [
            'accept' => 'application/json;version=1.0',
            'content-type' => 'application/json',
        ];
    }
}
