<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $categories = [
            ['name' => 'Продажи',],
            ['name' => 'Информационные технологии, интернет, телеком',],
            ['name' => 'Строительство, недвижимость',],
            ['name' => 'Маркетинг, реклама, PR',],
            ['name' => 'Начало карьеры, студенты',],
            ['name' => 'Административный персонал',],
            ['name' => 'Транспорт, логистика',],
            ['name' => 'Производство, сельское хозяйство',],
            ['name' => 'Рабочий персонал',],
            ['name' => 'Бухгалтерия, управленческий учет, финансы предприятия',],
            ['name' => 'Туризм, гостиницы, рестораны',],
            ['name' => 'Банки, инвестиции, лизингы',],
            ['name' => 'Медицина, фармацевтика',],
            ['name' => 'Управление персоналом, тренинги',],
            ['name' => 'Консультирование',],
            ['name' => 'Автомобильный бизнес',],
            ['name' => 'Искусство, развлечения, масс-медиа',],
            ['name' => 'Спортивные клубы, фитнес, салоны красоты',],
            ['name' => 'Высший менеджмент',],
            ['name' => 'Закупки',],
            ['name' => 'Юристы',],
            ['name' => 'Наука, образование',],
            ['name' => 'Безопасность',],
            ['name' => 'Инсталляция и сервис',],
            ['name' => 'Домашний персонал',],
            ['name' => 'Государственная служба, некоммерческие организации',],
            ['name' => 'Страхование',],
            ['name' => 'Добыча сырья'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
