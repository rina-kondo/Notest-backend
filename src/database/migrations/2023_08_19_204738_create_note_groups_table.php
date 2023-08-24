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
        Schema::create('note_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->comment('ユーザーID');
            $table->string('title', 20)->default("MEMO")->comment('メモグループ名');
            $table->integer('save_duration')->default(3)->comment('メモ単体の保存期限');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
