<?php

namespace App\Models\Product;

use App\Models\Model;
use App\Models\Store\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    public $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'position',
        'active',
        'discount', // percent
        'price',
        'slug',
        'sku',
        'category_id',
        'sub_category_id',
        'brand_id',
        'store_id',
        'image',
        'description',
        'in_top_selling',
        'in_special_offer',
        'offer_expired_at',
        'in_new',
        'stock', // no of available items
        'most_read',
        'no_views',
        'author_id',
        'publisher_id',
        'publication_year',
        'isbn', // ISBN number
        'publication_year', // Year of publication
        'page_count', // Number of pages
        'language', // Language of the book
        'book_type', // Book type (e.g., paperback, hardcover, etc.)
        'weight', // Weight of the book, in kilograms
        'dimensions', // Dimensions of the book (e.g., "8 x 5 x 1 inches")
        'extra_info', // Additional information (e.g., series name, edition, etc.)
    ];

    public function tags()
    {
        return $this->hasMany(ProductTag::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function getPriceAfterAttribute()
    {
        return $this->price - ($this->discount > 0 ? round($this->price * $this->discount / 100, 2) : 0);
    }

    public function getImagesAttribute()
    {
        $images = [];
        $files = $this->getMedia('document');
        if (!empty($files)) {
            foreach ($files as $file) {
                array_push($images, $file->getFullUrl());
            }
        }

        return $images;
    }

    public function scopeAvailable($query)
    {
        return $query->where('active', 1);
    }

    public function scopeNew($query)
    {
        return $query->where('in_new', 1);
    }

    public function scopeBestSeller($query)
    {
        return $query->where('in_top_selling', 1);
    }

    // MostRead
    public function scopeMostRead($query)
    {
        return $query->where('most_read', 1);
    }

    public function scopeSpecialOffers($query)
    {
        return $query->whereDate('offer_expired_at', '>=', date('Y-m-d'))
            ->where('in_special_offer', 1);
    }

    public function getUrlAttribute()
    {
        return route('website.store.show', ['locale' => app()->getLocale(), 'slug' => $this->slug]);
    }

    // is Favourite
    public function getIsFavouriteAttribute()
    {
        $favourite = 0;
        if (
            auth()->user()
            && Favourite::whereStatus(1)->where('product_id', $this->id)
            ->where('user_id', auth()->user()->id)->count() > 0
        ) {
            $favourite = 1;
        }

        return $favourite;
    }
}
