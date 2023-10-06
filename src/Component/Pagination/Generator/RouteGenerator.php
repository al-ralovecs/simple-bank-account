<?php

declare(strict_types=1);

namespace Component\Pagination\Generator;

use Pagerfanta\PagerfantaInterface;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final readonly class RouteGenerator
{
    /**
     * @param PagerfantaInterface<mixed> $pager
     */
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private Request $request,
        private PagerfantaInterface $pager,
    ) {
    }

    public function __invoke(int $page): string
    {
        /** @var string|null $route */
        $route = $this->request->attributes->get('_route');
        if (null === $route) {
            throw new RuntimeException('Route is not defined.');
        }

        return $this->urlGenerator->generate(
            (string) $route, // @phpstan-ignore-line
            array_merge(
                (array) $this->request->attributes->get('_route_params', []),
                $this->request->query->all(), [
                    'offset' => ($page - 1) * $this->pager->getMaxPerPage(),
                    'limit' => $this->pager->getMaxPerPage(),
                ],
            ),
            UrlGeneratorInterface::ABSOLUTE_URL,
        );
    }
}
