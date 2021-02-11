<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class C2BTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'c2b_transactions';
}
