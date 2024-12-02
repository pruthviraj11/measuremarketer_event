<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_registers', function (Blueprint $table) {

            $table->string('linkedin')->nullable()->after('designation');
            $table->string('total_experience')->nullable()->after('linkedin');
            $table->string('bio')->nullable()->after('total_experience');
            $table->longText('category')->nullable()->after('bio');
            $table->longText('interest')->nullable()->after('category');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_registers', function (Blueprint $table) {
            //
        });
    }
};
