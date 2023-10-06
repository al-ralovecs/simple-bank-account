<?php

declare(strict_types=1);

namespace Component\User\Bridge\Api\Responder;

use Component\Pagination\Response\Response;
use Component\User\Bridge\Api\Request\GetUserRequest;
use Component\User\Bridge\Api\Transformer\UserTransformer;
use Component\User\Operator\UserFetcherInterface;
use Component\User\Operator\UserInterface;

final readonly class GetUserActionResponder
{
    public function __construct(
        private UserFetcherInterface $userFetcher,
        private UserTransformer $userTransformer,
    ) {
    }

    /**
     * @return Response<UserInterface>
     */
    public function __invoke(GetUserRequest $request): Response
    {
        $user = $this->userFetcher->getById($request->userId());

        return new Response(
            $user,
            $this->userTransformer,
        );
    }
}
