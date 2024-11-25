<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function benefits(): BelongsToMany {
        return $this->belongsToMany(Benefit::class,"product_benefit");
    }

    public function ratings(): HasMany {
        return $this->hasMany(Rating::class);
    }

    public function type(): BelongsTo {
        return $this->belongsTo(ProductType::class);
    }

    public function programs(): HasMany {
        return $this->hasMany(Program::class);
    }
}
