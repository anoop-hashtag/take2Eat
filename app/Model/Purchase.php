<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function vendorDetails() {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
