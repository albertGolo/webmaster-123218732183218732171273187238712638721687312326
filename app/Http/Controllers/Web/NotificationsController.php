<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function index()
    {
        $config = config('badges');
        $badges = [];

        foreach ($config as $data) {
            $badge = new \stdClass;
            $badge->name = $data['name'];
            $badge->description = $data['description'];
            $badge->image = asset("img/badges/{$data['image']}.png");

            $badges[] = $badge;
        }

        return view('web.notifications.index')->with([
            'badges' => $badges
        ]);
    }
}
