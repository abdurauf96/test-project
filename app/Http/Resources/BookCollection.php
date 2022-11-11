<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'books' => $this->collection->map(function($data) {
                return [
                    'name'=>$data->name,
                    'authors'=>AuthorResource::collection($data->authors),
                    'publishers'=>PublisherResource::collection($data->publishers)
                ];
            })

        ];
    }
}
