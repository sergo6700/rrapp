<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use App\Models\Acl\User;
use App\Models\Acl\UserSource;
use App\Support\Enum\User\UserSourceType;

/**
 * Class FillInUserSourcesDataTable
 */
class FillInUserSourcesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $users = User::all();

        foreach ($users as $user) {
            UserSource::create([
                'user_id' => $user->id,
                'source' => UserSourceType::SITE,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('user_sources')) {
            DB::table('user_sources')->truncate();
        }
    }
}
