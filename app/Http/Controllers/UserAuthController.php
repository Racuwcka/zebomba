<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserAuthController extends MainController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        $data = self::validateData($request->all());
        $result = $this->service->sort($data);
        return response()->json($result);
    }

    private static function validateData(array $data): array
    {
        foreach ($data as $key => $item) {
            $data[$key] = self::sanitizeString($item);
        }
        return $data;
    }
    private static function sanitizeString(string $data): string
    {
        $data = trim($data);
        $data = strip_tags($data);
        return htmlspecialchars($data);
    }
}
