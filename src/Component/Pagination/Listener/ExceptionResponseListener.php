<?php

declare(strict_types=1);

namespace Component\Pagination\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final readonly class ExceptionResponseListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $event->setResponse(new JsonResponse([
            'status' => 'failed',
            'error' => $exception->getMessage(),
        ], 400));
    }
}
