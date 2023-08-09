<?php

declare( strict_types = 1);

namespace App\Http\Controllers\Clients;

use App\Enums\Role;
use App\Models\Client;
use Illuminate\Http\Request;
use Treblle\Tools\Http\Enums\Status;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\ClientResource;
use App\Services\AuthorizationService;
use App\Exceptions\AuthorizationException;
use Illuminate\Contracts\Support\Responsable;
use Treblle\Tools\Http\Responses\CollectionResponse;

final class IndexController
{

    public function __construct(
        private readonly AuthorizationService $service
    ) {}

    /**
     * @param Request $request
     * @return Responsable
     * @throws AuthorizationException
     */
    public function __invoke(Request $request) : Responsable
    {
        if (! this->service->listClients(
            role: Role::tryFrom(data_get($request->all(),'identity.role')),
        )) {
            throw new AuthorizationException(
                message: "Inadequate role to access this resource.",
                code: Status::FORBIDDEN->value,
            );
        }

        return new CollectionResponse(
            data: ClientResource::collection(
                resource: QueryBuilder::for(
                    subject: Client::query(),
                )->allowIncludes([
                    'company'
                ])->latest()->paginate(), 
            ),
        );
    }
}
