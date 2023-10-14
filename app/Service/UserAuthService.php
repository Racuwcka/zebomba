<?php

namespace App\Service;

use App\Models\User;
use App\Models\UsersSessions;
use Illuminate\Support\Facades\DB;

class UserAuthService
{
    public function sort($data)
    {
        try {
            DB::beginTransaction();
            ksort($data);
            if (isset($data['sig'])) {
                $sig = $data['sig'];
                unset($data['sig']);
            }

            $string = '';
            foreach ($data as $key => $item) {
                $string .= $key . '=' . $item;
            }
            $string .= UsersSessions::$secretKey;

            if (mb_strtolower(md5($string), 'UTF-8') === $sig) {
                $access['access_token'] = $data['access_token'];
                unset($data['access_token']);

                User::updateOrInsert(['id' => $data['id']], $data);
                UsersSessions::updateOrInsert(['user_id' => $data['id']], $access);

                DB::commit();

                return [
                    "access_token" => $access['access_token'],
                    "user_info" => [
                        "id" => $data['id'],
                        "first_name" => $data['first_name'],
                        "last_name" => $data['last_name'],
                        "city" => $data['city'],
                        "country" => $data['country'],
                    ],
                    "error" => "",
                    "error_key" => "",
                ];
            } else {
                return [
                    "error" => "Ошибка авторизации в приложении",
                    "error_key" => "signature error"
                ];
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }
}
