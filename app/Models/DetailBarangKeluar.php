<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DetailBarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'detail_barang_keluar';
    protected $fillable = ['no_trx','id_barang','jumlah','harga','subtotal'];

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

    public function barang(){
        return $this->belongsTo(Barang::class,'id_barang');
    }
}
