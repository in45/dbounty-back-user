<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('company_id');
            $table->string('type')->default('public');//public,private,test
            $table->string('logo')->default("http://via.placeholder.com/640x480.png/8F82A0?text=program");
            $table->string('status')->default('none');// 0:none , 1:new , 2:open , 3:closed
            $table->float('min_bounty')->default(0);
            $table->float('max_bounty')->default(0);
            $table->timestamp('begin_at')->nullable();
            $table->timestamp('finish_at')->nullable();
            $table->integer('range_response')->default(0);//days
            $table->json('description')->nullable();
            $table->text('scopes')->nullable();
            $table->text('rules')->nullable();
            $table->text('conditions')->nullable();
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
        Schema::dropIfExists('programs');
    }
}
