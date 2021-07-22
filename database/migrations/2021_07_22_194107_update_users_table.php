<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table
                ->foreignId('birth_city_id')
                ->nullable()
                ->references('id')
                ->on('cities')
                ->onDelete('set null');

            $table
                ->foreignId('current_city_id')
                ->nullable()
                ->references('id')
                ->on('cities')
                ->onDelete('set null');

            $table->enum('education', User::EDUCATION)->nullable();
            $table->string('help_needed')->nullable();
            $table->string('help_offer')->nullable();
            $table->string('areas_of_interest')->nullable();
            $table->string('career')->nullable();
            $table->integer('age')->nullable();
            $table->string('surname')->nullable();
            $table->string('patronymic')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('gender', User::GENDER)->nullable();

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
        //
    }
}
