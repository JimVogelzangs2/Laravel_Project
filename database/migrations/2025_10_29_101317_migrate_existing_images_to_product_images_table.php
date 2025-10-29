<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate existing image_path data to product_images table
        $products = DB::table('products')->whereNotNull('image_path')->get();

        foreach ($products as $product) {
            DB::table('product_images')->insert([
                'product_id' => $product->id,
                'image_path' => $product->image_path, // Access as property
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Remove the image_path column after migration
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the image_path column
        Schema::table('products', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('description');
        });

        // Migrate data back from product_images to products table
        $productImages = DB::table('product_images')->get();

        foreach ($productImages as $image) {
            DB::table('products')
                ->where('id', $image->product_id)
                ->update(['image_path' => $image->image_path]);
        }

        // Remove migrated images from product_images table
        DB::table('product_images')->delete();
    }
};
