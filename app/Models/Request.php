<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'nama',
        'nomor',
        'category',
        'description',
        'document',
        'status',
        'user_id',
    ];

    // Accessor untuk kompatibilitas dengan view
    public function getNamaPengirimAttribute()
    {
        return $this->nama;
    }

    public function getKategoriAttribute()
    {
        return $this->category;
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
