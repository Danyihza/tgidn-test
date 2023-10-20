<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data['id'] = $this->id;
        $data['nama_kendaraan'] = $this->name;
        $data['tipe_kendaraan'] = $this->type_name;
        $data['nomor_polisi'] = $this->reg_no;
        $data['created_at'] = $this->created_at;
        $data['updated_at'] = $this->updated_at;
        return $data;
    }
}
