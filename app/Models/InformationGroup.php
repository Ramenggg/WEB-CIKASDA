<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationGroup extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'num', 'title'];

    public function items()
    {
        return $this->hasMany(InformationItem::class, 'information_group_id');
    }
}
