<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StringController extends Controller
{
    // index
    public function index(Request $request)
    {
        $messages = [];
        $users = collect([
            ["name" => "Joe Gitonga", "amount" => 2500],
            ["name" => "Aria Kawira", "amount" => 2400],
            ["name" => "Nora Kendi", "amount" => 2800]
        ]);

        foreach ($users as $key => $user) {
            $messages[] = __('Hi :name, please pay KES :amount by tomorrow morning.', [
                'name' => $user['name'],
                'amount' => number_format($user['amount'], 2),
            ]);
        }
        return response()->json($messages);
    }
}
