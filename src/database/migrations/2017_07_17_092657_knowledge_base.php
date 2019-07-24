<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KnowledgeBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campus_knowledge', function (Blueprint $table) {
            $table->uuid('id')->index()->primary();
            $table->boolean('active')->default(false);
            $table->uuid('cover_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('title');
            $table->text('preview_text')->nullable();
            $table->longText('text');
            $table->jsonb('blocked_text')->default('{}');
            $table->integer('language_id');
            $table->string('permission');
            $table->integer('company_id')->index();
            $table->dateTime('publish_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')
                ->references('id')
                ->on('company')
                ->onDelete('cascade');
        });

        Schema::create('campus_knowledge_content_types', function (Blueprint $table) {
            $table->uuid('content_type_id')->index();
            $table->uuid('campus_knowledge_id')->index();

            $table->foreign('content_type_id')
                ->references('id')
                ->on('content_types')
                ->onDelete('cascade');

            /*            $table->foreign('campus_knowledge_id')
                            ->references('id')
                            ->on('campus_knowledge')
                            ->onDelete('cascade');*/
        });

        Schema::create('campus_knowledge_directions', function (Blueprint $table) {
            $table->uuid('directions_id')->index();
            $table->uuid('campus_knowledge_id')->index();

            $table->foreign('directions_id')
                ->references('id')
                ->on('directions')
                ->onDelete('cascade');

            /*            $table->foreign('campus_knowledge_id')
                            ->references('id')
                            ->on('campus_knowledge')
                            ->onDelete('cascade');*/
        });

        Schema::create('campus_knowledge_processes', function (Blueprint $table) {
            $table->uuid('processes_id')->index();
            $table->string('processes_type')->index();
            $table->uuid('campus_knowledge_id')->index();
            /*
                        $table->foreign('campus_knowledge_id')
                            ->references('id')
                            ->on('campus_knowledge')
                            ->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campus_knowledge_content_types', function (Blueprint $table) {
            $table->dropForeign(['content_type_id']);
            $table->drop();
        });

        Schema::table('campus_knowledge_directions', function (Blueprint $table) {
            $table->dropForeign(['directions_id']);
            $table->drop();
        });

        Schema::table('campus_knowledge_processes', function (Blueprint $table) {
            $table->drop();
        });

        Schema::table('campus_knowledge', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->drop();
        });
    }
}
