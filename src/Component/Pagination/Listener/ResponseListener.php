<?php

declare(strict_types=1);

namespace Component\Pagination\Listener;

use Component\Pagination\Response\ResponseInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;

final class ResponseListener
{
    public function __invoke(ViewEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $resource = $event->getControllerResult();
        if (!$resource instanceof ResponseInterface) {
            return;
        }

        $event->setControllerResult($resource->toResource());
    }
}
