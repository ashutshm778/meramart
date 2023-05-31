<?php

namespace App\Models\Admin;

use App\Models\DealerCart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'added_by',
        'product_group_id',
        'slug',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'brand_id',
        'name',
        'variant_name',
        'description',
        'colors',
        'attribute',
        'attribute_value',
        'thumbnail_image',
        'gallery_image',
        // 'purchase_price',
        // 'mrp_price',
        'retailer_selling_price',
        'retailer_discount_type',
        'retailer_discount',
        'distributor_selling_price',
        'distributor_discount_type',
        'distributor_discount',
        'wholeseller_selling_price',
        'wholeseller_discount_type',
        'wholeseller_discount',
        'retailer_min_qty',
        'retailer_max_qty',
        'distributor_min_qty',
        'wholeseller_min_qty',
        'unit',
        'hsn_code',
        'sku',
        'tax_type',
        'tax_amount',
        'shipping_type',
        'shipping_amount',
        'specification',
        'tags',
        'video_link',
        'barcode_id',
        'retailer_point',
        'distributor_point',
        'wholeseller_point',
        'current_stock',
        'meta_title',
        'meta_key_word',
        'meta_description',
        'meta_image',
        'is_refundable',
        'is_active',
        'is_feature',
        'is_trending',
        'is_bestseller',
        'is_new_arrival',
    ];

    protected $casts = [
        'category_id' => 'array',
        'subcategory_id' => 'array',
        'subsubcategory_id' => 'array',
        'attribute' => 'array',
        'attribute_value' => 'array',
    ];

    public function brand()
    {
        return $this->belongsTo(Brnad::class,'brand_id');
    }

    public function dealerCart(){
        return $this->belongsTo(DealerCart::class,'id','product_id');
    }

}
