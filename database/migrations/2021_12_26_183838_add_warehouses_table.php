<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse', function (Blueprint $table) {
            $table->string('ref', 36);
            $table->string('description', 99);
            $table->string('description_ru', 99);
            $table->string('short_address');
            $table->string('short_address_ru');
            $table->string('phone');
            $table->string('type_of_warehouse', 36);
            $table->string('city_ref', 36);
            $table->string('city_description', 50);
            $table->string('city_description_ru', 50);
            $table->string('settlement_ref');
            $table->string('settlement_description');
            $table->string('settlement_area_description');
            $table->string('settlement_regions_description');
            $table->string('settlement_type_description');
            $table->string('settlement_type_description_ru');
            $table->string('bicycle_parking');
            $table->string('payment_access');
            $table->string('width');
            $table->string('height');
            $table->string('length');
            $table->string('category_of_warehouse');
            $table->string('warehouse_status');
            $table->string('warehouse_status_date');
            $table->string('district_code');
            $table->string('direct');
            $table->string('region_city');
            $table->float('site_key');
            $table->boolean('post_finance');
            $table->boolean('posterminal');
            $table->boolean('international_shipping');
            $table->boolean('self_service_workplaces_count');
            $table->boolean('warehouse_for_agent');
            $table->smallInteger('longitude');
            $table->smallInteger('latitude');
            $table->integer('number');
            $table->integer('total_max_weight_allowed');
            $table->integer('place_max_weight_allowed');
            $table->integer('max_declared_cost');
            $table->json('sending_limitations_on_dimensions');
            $table->json('schedule');
            $table->json('delivery');
            $table->json('reception');
            $table->json('receiving_limitations_on_dimensions');

            $table->primary('ref');
            $table->index('city_ref');
            $table->index('type_of_warehouse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse');

    }
}
