<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRestFieldsToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->text('dedication')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->integer('percent_complete')->default(0);
            $table->boolean('published')->default(false);
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('dedication');
            $table->dropColumn('description');
            $table->dropColumn('website');
            $table->dropColumn('percent_complete');
            $table->dropColumn('published');
        });
    }
}
