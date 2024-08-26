<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageUrlToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
// database/migrations/YYYY_MM_DD_add_image_url_to_products_table.php

public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('image_url')->after('category'); // Menyimpan path gambar di file system
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('image_url');
    });
}
}
                                                                                                                                                                                                                                                                                                