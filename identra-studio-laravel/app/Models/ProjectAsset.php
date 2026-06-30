<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAsset extends Model
{
    protected $fillable = ['transaction_id', 'file_name', 'file_path', 'file_size'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}