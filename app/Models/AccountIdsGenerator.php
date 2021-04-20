<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AccountIdsGenerator extends Model
{
    use HasFactory;

    protected $table = "account_ids_generator";

    public function generatedAccountId()
    {
        $account_id_generator = AccountIdsGenerator::find(1);
        $account_id_generator->uid_count += 1;
        $account_id_generator->save();

        $prefix = $account_id_generator->prefix;
        $separator = $account_id_generator->separator;
        $uid_count = $account_id_generator->uid_count;

        $permanent_account_id_generator = $prefix . $separator . Str::padLeft($uid_count, 9, 0);

        return $permanent_account_id_generator;
    }
}
