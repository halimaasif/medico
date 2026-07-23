<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiagnosticHistory;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    // History page show karne ke liye
    public function index()
    {
        // Sirf login user ka data nikalein
        $history = DiagnosticHistory::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('profile.history', compact('history'));
    }

    // Naya record save karne ke liye (Symptom Checker se call hoga)
    public function store(Request $request)
    {
        $request->validate([
            'keywords' => 'required',
            'condition_name' => 'required',
            'severity_levels' => 'required',
        ]);

        DiagnosticHistory::create([
            'user_id' => Auth::id(),
            'keywords' => $request->keywords,
            'condition_name' => $request->condition_name,
            'severity_levels' => $request->severity_levels,
        ]);

        return response()->json(['success' => 'History saved!']);
    }
}