<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StuddentsResource extends ResourceCollection
{
    public $status;
    public $message;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

     public function __construct($status, $message, $resource)
     {
        # code...
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
     }

     public function toArray($request)
    {
        return [
            'successz' => $this->status,
            'messagez' => $this->message,
            'data' => $this->resource

        ];
    }
}
