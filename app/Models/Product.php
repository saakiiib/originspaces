<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'model_code', 'tagline', 'description',
        'dimensions', 'lead_time', 'warranty', 'base_price', 'hero_image', 'video_url',
        'show_3d', 'is_featured', 'status', 'sort_order',
        'meta_title', 'meta_description', 'meta_keywords', 'meta_image',
    ];

    protected function casts(): array
    {
        return [
            'base_price' => 'decimal:2',
            'show_3d' => 'boolean',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function materials(): HasMany
    {
        return $this->hasMany(ProductMaterial::class)->orderBy('sort_order');
    }

    public function specs(): HasMany
    {
        return $this->hasMany(ProductSpec::class)->orderBy('sort_order');
    }

    public function options(): HasMany
    {
        return $this->hasMany(ProductOption::class)->orderBy('sort_order');
    }

    public function techSpecs(): HasMany
    {
        return $this->hasMany(ProductTechSpec::class)->orderBy('sort_order');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ProductDocument::class)->orderBy('sort_order');
    }

    /** Effective video: product override else category video. */
    public function effectiveVideoUrl(): ?string
    {
        return $this->video_url ?: $this->category?->video_url;
    }

    /** Frontend SEO array shape for SEOMeta/OpenGraph. */
    public function seoArray(): array
    {
        return [
            'title' => $this->meta_title ?: $this->name,
            'description' => $this->meta_description ?: $this->tagline,
            'keywords' => $this->meta_keywords,
            'image' => $this->meta_image ?: $this->hero_image,
        ];
    }
}
