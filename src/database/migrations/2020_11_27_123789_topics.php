<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Topics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('active')->default(false);
            $table->uuid('cover_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('title');
            $table->string('note')->nullable();
            $table->text('text');
            $table->integer('company_id');
            $table->uuid('website_id');
            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['uri_code', 'website_id', 'active']);
            $table->foreign('website_id')->on('website')->references('id')->onDelete('cascade');
            $table->foreign('company_id')->on('company')->references('id')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topics');
    }
}
