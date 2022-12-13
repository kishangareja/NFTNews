<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('press_releases', function (Blueprint $table) {
            $table->id();
            $table->string('categoryId');
            $table->string('authorId');
            $table->string('title');
            $table->longText('shortDescription');
            $table->longText('fullDescription');
            $table->string('image')->nullable();
            $table->string('article_1')->nullable();
            $table->string('article_2')->nullable();
            $table->longText('pressType');
            $table->enum('fld_status',['Active','Inactive'])->default('Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('press_releases');
    }
};
