
<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AgencyController extends Controller
{
    public function index(Request $request)
    {
        $agencies = Agency::with(['user', 'approver'])
            ->when($request->status, function($query) use ($request) {
                $query->whereHas('user', function($q) use ($request) {
                    $q->where('agency_status', $request->status);
                });
            })
            ->paginate(10);

        return response()->json($agencies);
    }
   
    public function approve(Request $request, $id)
    {
        $agency = Agency::findOrFail($id);

        DB::transaction(function() use ($agency, $request) {
            $agency->user->update(['agency_status' => 'approved']);
            $agency->update([
                'approved_at' => now(),
                'approved_by' => $request->user()->id,
            ]);
        });

        return response()->json(['message' => 'Agency approved successfully']);
    }

    public function reject(Request $request, $id)
    {
        $agency = Agency::findOrFail($id);

        $agency->user->update(['agency_status' => 'rejected']);

        return response()->json(['message' => 'Agency rejected']);
    }

    public function updateLevel(Request $request, $id)
    {
        $request->validate([
            'level' => 'required|integer|between:1,5'
        ]);

        $agency = Agency::findOrFail($id);
        $agency->update(['level' => $request->level]);

        return response()->json(['message' => 'Agency level updated']);
    }

    public function commissions($id)
    {
        $agency = Agency::with('commissions.order')->findOrFail($id);
        return response()->json($agency->commissions);
    }
}
