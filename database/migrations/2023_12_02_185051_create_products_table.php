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
            $table->string('slug', 70)->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('short_description');
            $table->text('long_description');
            $table->integer('available_quantity');
            $table->integer('sales_count')->default(0); // Set the default value to 0
            $table->decimal('original_price', 10, 2);
            $table->decimal('purchase_price', 10, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

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
