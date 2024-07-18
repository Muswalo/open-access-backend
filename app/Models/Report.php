<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'store_id',
        'report_type',
        'data',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
