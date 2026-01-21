<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditTrail;

class AuditTrailController extends Controller
{
    public function index(Request $request)
    {
        $range = $request->query('range', '30');
        $search = $request->query('search');
        $query = AuditTrail::query();
        if ($range !== 'all') {
            if ($range == '0') {
                $query->whereDate('created_at', today());
            } else {
                $query->where('created_at', '>=', now()->subDays($range));
            }
        }
        if ($search) {
            $query->where('item_name', 'LIKE', "%{$search}%");
        }
        $logs = $query->orderBy('created_at', 'desc')->paginate(10);        
        return view('menu-pricing.audit-trail', compact('logs'));
    }
}