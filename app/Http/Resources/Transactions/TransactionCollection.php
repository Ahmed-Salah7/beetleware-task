<?php
/*
Dev Omar Shaheen
Devomar095@gmail.com
WhatsApp +972592554320
*/

namespace App\Http\Resources\Transactions;


use App\Http\Resources\Transactions\TransactionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Admin */
class TransactionCollection extends ResourceCollection
{
    private $pagination;
    public function __construct($resource)
    {
        $this->pagination = [
            'total' => $resource->total(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'from' => $resource->firstItem(),
            'to' => $resource->lastItem(),
            'first_page_url' => $resource->url(1),
            'last_page' => $resource->lastPage(),
            'last_page_url' => $resource->url($resource->lastPage()),
            'next_page_url' => $resource->nextPageUrl(),
            'prev_page_url' => $resource->previousPageUrl(),
        ];
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return ['pagination' => $this->pagination, 'items' => TransactionResource::collection($this->collection)];
    }
}
