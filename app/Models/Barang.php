<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Barang extends Model
{
    use HasFactory;
    use HasFactory;
    use HasFactory;
    use SoftDeletes;
    protected $table = 'barang';
    protected $dates = ['deleted_at'];
    protected $fillable = ['nama','kode','id_kategori','id_satuan','id_brand','stok','stok_minimal','harga_beli','harga_jual','keterangan','lokasi','gambar'];
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

    public function kategori(){
        return $this->belongsTo(Kategori::class,'id_kategori');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'id_brand');
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class,'id_satuan');
    }

    public function detailbarang(){
        return $this->hasMany(DetailBarangMasuk::class);
    }
}
