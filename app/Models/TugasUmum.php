<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasUmum extends Model
{
    use HasFactory;
        protected $fillable = ['name','deadline','rombel', 'namatugas'];   

}
