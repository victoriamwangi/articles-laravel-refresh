<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;


class Utils
{

    static  public function get_user($request)
    {
        // dd($request->header('authorization'));
        [$id, $user_token] = explode('|', $request->header('authorization'), 2);
        $token_data = DB::table('personal_access_tokens')->where('token', hash('sha256', $user_token))->first();
        $user_id = $token_data->tokenable_id;

        return $user_id;
    }
}
