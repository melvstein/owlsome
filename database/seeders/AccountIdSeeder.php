<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountIdsGenerator;

class AccountIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accountId = new AccountIdsGenerator;
        $accountId->create([
            'prefix' => 'SO',
            'separator' => '-',
            'uid_count' => '1',
        ]);
    }
}
