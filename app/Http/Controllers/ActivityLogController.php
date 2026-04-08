<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index()
    {
        if (Auth::user()->peran != 'admin') {
            abort(403);
        }

        $logs = ActivityLog::with('user')->latest()->get();
        return view('admin.log_aktivitas.index', compact('logs'));
    }
}
