<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\EmploymentType;

class CreateEmploymentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $types = [
            ['name' => 'Полная занятость'],
            ['name' => 'Частичная занятость'],
            ['name' => 'Проектная работа'],
            ['name' => 'Волонтерство'],
            ['name' => 'Стажировка'],
        ];

        foreach ($types as $type) {
            EmploymentType::create($type);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employment_types');
    }
}
