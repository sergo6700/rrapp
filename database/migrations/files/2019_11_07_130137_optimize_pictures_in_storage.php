<?php

use Illuminate\Database\Migrations\Migration;
use App\Support\Picture\PictureOptimizer;

/**
 * Class OptimizePicturesInStorage
 */
class OptimizePicturesInStorage extends Migration
{
    /**
     * Directory path
     *
     * @var string $pathToStorage
     */
    protected $pathToStorage;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->pathToStorage = storage_path();

        PictureOptimizer::run($this->pathToStorage);
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
