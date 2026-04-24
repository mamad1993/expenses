<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MunSection extends Model
{
    public function details()
    {
        return $this->hasMany(MunSectionDetails::class, 'mun_section_id');

    }
}
