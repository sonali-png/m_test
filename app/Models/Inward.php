<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use DB;
class Inward extends Model
{
    use HasFactory;
    protected $fillable = ["category_id", "material_id", "inward_qty", "outward_qty", "transaction_at"];

    public function materials(): HasOne
    {

        return $this->hasOne(Material::class, 'id', 'material_id');
    }
    public function categories(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
