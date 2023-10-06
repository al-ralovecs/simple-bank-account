<?php

declare(strict_types=1);

namespace Component\Pagination\Listener;

use Component\Pagination\Generator\RouteGenerator;
use Component\Pagination\Response\PaginatedResponseInterface;
use League\Fractal\Pagination\PagerfantaPaginatorAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final readonly class PaginatedResponseListener
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
    ) {
    }

    public function __invoke(ViewEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $resource = $event->getControllerResult();
        if (!$resource instanceof PaginatedResponseInterface) {
            return;
        }
        $paginator = $resource->paginator();
        if (!$paginator instanceof Pagerfanta) {
            return;
        }

        $collection = $resource->toResource();
        $collection->setPaginator(new PagerfantaPaginatorAdapter(
            $paginator,
            new RouteGenerator($this->urlGenerator, $event->getRequest(), $paginator),
        ));

        $event->setControllerResult($collection);
    }
}
