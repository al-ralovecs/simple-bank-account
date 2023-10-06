<?php

declare(strict_types=1);

namespace Component\Pagination\Listener;

use Component\Pagination\Serializer\ArraySerializer;
use League\Fractal\Manager;
use League\Fractal\Resource\ResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;

final class ResourceProcessingListener
{
    public function __invoke(ViewEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $resource = $event->getControllerResult();
        if (!$resource instanceof ResourceInterface) {
            return;
        }

        $result = (new Manager())
            ->setSerializer(new ArraySerializer())
            ->createData($resource)
            ->toArray();

        $event->setResponse(new JsonResponse($result));
    }
}
