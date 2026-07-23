<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Models\SymptomData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Schema;

class SymptomController extends Controller
{
    public function index()
    {
        return view('form'); 
    }

    public function profileSettings()
    {
        // Jo user logged in hai, uski details pass karein view mein
        $user = auth()->user();
        return view('profile.settings', compact('user'));
    }

    public function diagnosticHistory()
    {
        // Direct Symptom table se data query karein jahan user_id current logged-in user ki ho
        // Aur taake purani bimarion ka master data (jisme user_id null hai) yahan display na ho
        $history = Symptom::where('user_id', auth()->id())->latest()->get(); 
        
        // Data ko view file ke andar bhej dein
        return view('profile.history', compact('history'));
    }

    public function getSymptomDataJson()
    {
        $data = Symptom::all(); // Agar table ek hi hai toh direct Symptom model use karein
        return response()->json($data);
    }

    /**
     * AJAX/Live Symptom Checker Engine
     * Yeh method front-end ke inputs aur query matching dono handle karega
     */
   public function checkSymptoms(Request $request)
{
    $input = trim($request->input('symptoms', ''));
    $results = \App\Models\Symptom::where('keywords', 'LIKE', '%' . $input . '%')->get();

    return response()->json($results->map(function ($item) {
        return [
            // Check karein ki DB column name kya hai, agar 'condition_name' hai toh thik hai
            'condition_name' => $item->condition_name ?? 'Unknown',
            'severity_levels' => $item->severity_levels ?? 'N/A',
            'medications' => is_string($item->medications) ? json_decode($item->medications, true) : $item->medications
        ];
    }));
}
}