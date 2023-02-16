<?php

namespace App\Models;

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Supplier extends Model
{
    use HasFactory;
    use HasFactory;
    use SoftDeletes;
    protected $table = 'supplier';
    protected $dates = ['deleted_at'];
    protected $fillable = ['nama','alamat','no_hp'];
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
            $model->created_at = Carbon::now();
            $model->updated_at = Carbon::now();
        });
        static::saving(function ($model) {
            $model->updated_by = Auth::id();
            $model->updated_at = Carbon::now();
        });
    }
}
