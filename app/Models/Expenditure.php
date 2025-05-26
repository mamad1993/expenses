<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');

    }


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
