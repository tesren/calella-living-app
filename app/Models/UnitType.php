<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class UnitType extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * Get all of the units for the UnitType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(450)->keepOriginalImageFormat()->nonOptimized()->nonQueued();
        
        $this->addMediaConversion('medium')->width(1280)->keepOriginalImageFormat()->nonOptimized()->nonQueued();
        
        $this->addMediaConversion('large')->width(1920)->keepOriginalImageFormat()->nonOptimized()->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blueprints');

        $this->addMediaCollection('gallery');
    }

    protected function getInteriorConstAttribute($value)
    {
        if (App::isLocale('en')) {
            return (round($value * 10.764, 2));
        }else{
            return $value;
        }
    }

    protected function getExteriorConstAttribute($value)
    {
        if (App::isLocale('en')) {
            return (round($value * 10.764, 2));
        }else{
            return $value;
        }
    }

    protected function getConstTotalAttribute($value)
    {
        if (App::isLocale('en')) {
            return (round($value * 10.764, 2));
        }else{
            return $value;
        }
    }
}
