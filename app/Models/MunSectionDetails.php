<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MunSectionDetails extends Model
{
    public function section()
    {
        return $this->belongsTo(MunSection::class, 'mun_section_id');
    }
}
