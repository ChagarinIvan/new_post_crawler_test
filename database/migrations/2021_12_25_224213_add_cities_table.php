<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
            $table->string('ref', 36);
            $table->string('description', 50);
            $table->string('description_ru', 50);
            $table->boolean('delivery_1');
            $table->boolean('delivery_2');
            $table->boolean('delivery_3');
            $table->boolean('delivery_4');
            $table->boolean('delivery_5');
            $table->boolean('delivery_6');
            $table->boolean('delivery_7');
            $table->string('area', 36);
            $table->string('settlement_type', 36);
            $table->boolean('is_branch');
            $table->string('prevent_entry_new_streets_user')->nullable();
            $table->string('conglomerates')->nullable();
            $table->integer('city_id');
            $table->string('settlement_type_description_ru', 36);
            $table->string('settlement_type_description', 36);

            $table->primary('ref');
            $table->index('area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city');
    }
}
