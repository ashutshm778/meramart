<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('added_by')->nullable();
            $table->string('product_group_id');
            $table->string('slug')->nullable();
            $table->string('category_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->string('subsubcategory_id')->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->string('name')->nullable();
            $table->string('variant_name')->nullable();
            $table->longText('description')->nullable();
            $table->string('colors')->nullable();
            $table->text('attribute')->nullable();
            $table->longText('attribute_value')->nullable();
            $table->bigInteger('thumbnail_image')->nullable();
            $table->string('gallery_image')->nullable();
            // $table->double('purchase_price')->default(0.00);
            // $table->double('mrp_price')->default(0.00);
            $table->double('retailer_selling_price',15,2)->default(0.00);
            $table->string('retailer_discount_type')->default('flat');
            $table->double('retailer_discount',15,2)->default(0.00);
            $table->double('distributor_selling_price',15,2)->default(0.00);
            $table->string('distributor_discount_type')->default('flat');
            $table->double('distributor_discount',15,2)->default(0.00);
            $table->double('wholeseller_selling_price',15,2)->default(0.00);
            $table->string('wholeseller_discount_type')->default('flat');
            $table->double('wholeseller_discount',15,2)->default(0.00);
            $table->bigInteger('retailer_min_qty')->default(1);
            $table->bigInteger('retailer_max_qty')->nullable();
            $table->bigInteger('distributor_min_qty')->default(1);
            $table->bigInteger('wholeseller_min_qty')->default(1);
            $table->string('unit')->nullable();
            $table->string('hsn_code')->nullable();
            $table->string('sku')->nullable();
            $table->string('tax_type')->nullable();
            $table->double('tax_amount',15,2)->default(0.00);
            $table->string('shipping_type')->default('free');
            $table->double('shipping_amount',15,2)->default(0.00);
            $table->longText('specification')->nullable();
            $table->longText('tags')->nullable();
            $table->longText('video_link')->nullable();
            $table->longText('barcode_id')->nullable();
            $table->double('retailer_point',15,2)->default(0.00);
            $table->double('distributor_point',15,2)->default(0.00);
            $table->double('wholeseller_point',15,2)->default(0.00);
            $table->bigInteger('current_stock')->default(0);
            $table->string('meta_title')->nullable();
            $table->longText('meta_key_word')->nullable();
            $table->longText('meta_description')->nullable();
            $table->bigInteger('meta_image')->nullable();
            $table->boolean('is_refundable')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_feature')->default(0);
            $table->boolean('is_trending')->default(0);
            $table->boolean('is_bestseller')->default(0);
            $table->boolean('is_new_arrival')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
