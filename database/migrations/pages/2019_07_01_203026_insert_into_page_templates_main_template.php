<?php

use App\Models\Pages\PageTemplate;
use Illuminate\Database\Migrations\Migration;

class InsertIntoPageTemplatesMainTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PageTemplate::create([
            'name' => 'Основной',
            'template' => 'main.blade.php',
            'class_name' => '.main-template',
            'styles' => '.main-template {
            
}',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        PageTemplate::where('class_name', '.main-template')
            ->first()
            ->delete();
    }
}
