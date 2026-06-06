<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'information_group_id',
        'title',
        'detail',
        'link',
        'type',
        'status',
        'dasar_hukum'
    ];

    public function group()
    {
        return $this->belongsTo(InformationGroup::class, 'information_group_id');
    }
}
