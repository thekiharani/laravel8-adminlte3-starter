<?php

namespace App\Models;

use App\Traits\HasUuidPk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class C2BTransaction extends Model
{
    use HasFactory, SoftDeletes, HasUuidPk;

    protected $table = 'c2b_transactions';
}
