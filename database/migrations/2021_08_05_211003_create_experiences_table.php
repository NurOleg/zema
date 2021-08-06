<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Experience;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $experiences = [
            ['name' => 'Не требуется'],
            ['name' => 'До 1-го года'],
            ['name' => 'От 1-го года до 3-х лет'],
            ['name' => 'От 3-х до 6-ти лет'],
            ['name' => 'Более 6-ти лет'],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiences');
    }
}
