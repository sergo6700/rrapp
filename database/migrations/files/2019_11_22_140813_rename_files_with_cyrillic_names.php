<?php

use App\Models\File\File;
use Illuminate\Database\Migrations\Migration;
use App\Support\Files\FileHandlerForRenamingCyrillicNames;

/**
 * Class RenameFilesWithCyrillicNames
 */
class RenameFilesWithCyrillicNames extends Migration
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
        $this->pathToStorage = storage_path() . '/app/public';
        (new FileHandlerForRenamingCyrillicNames())->run($this->pathToStorage);

        $extraCharacter = FileHandlerForRenamingCyrillicNames::EXTRA_CHARACTER;

        $files = File::where('filename', 'regexp', FileHandlerForRenamingCyrillicNames::CYRILLIC_LETTER_PATTERN_FOR_DB)
            ->get();

        $files->each(function ($file) use($extraCharacter) {
            $name = $file->filename;

            $ext = pathinfo($name, PATHINFO_EXTENSION);

            $pattern = '(\.' . $ext .')$';
            $nameWithoutExtension = mb_ereg_replace($pattern, '', $name);

            if ($nameWithoutExtension) {
                $newName = $extraCharacter . $nameWithoutExtension . $extraCharacter . '.' . $ext;

                $file->filename = $newName;
                $file->original_name = $newName;


                $url = str_replace($name, $newName, $file->url);
                $file->url = $url;

                $path = str_replace($name, $newName, $file->path);
                $file->path = $path;

                $file->save();
            }
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
