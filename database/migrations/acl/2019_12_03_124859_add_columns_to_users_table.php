<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Acl\User;

/**
 * Class AddColumnsToUsersTable
 */
class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('legal_address')
				->nullable()
				->after('company_name')
				->comment('Юридический адрес');

			$table->text('actual_address')
				->nullable()
				->after('legal_address')
				->comment('Фактический адрес');

			$table->char('kpp', User::KPP_LENGTH)
				->nullable()
				->after('actual_address')
				->comment('КПП (Код причины постановки на учёт)');

			$table->char('ogrn', User::OGRN_MAX_LENGTH)
				->nullable()
				->after('kpp')
				->comment('ОГРН (основной государственный регистрационный номер)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('legal_address');
            $table->dropColumn('actual_address');
            $table->dropColumn('kpp');
            $table->dropColumn('ogrn');
        });
    }
}
