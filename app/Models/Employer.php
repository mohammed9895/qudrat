<?php

namespace App\Models;

use App\Enums\EmployerCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Employer extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'category',
        'is_active',
        'sort',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'category' => EmployerCategory::class,
    ];

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
