<?php

namespace App\Http\Controllers;


use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\SupervisorReport;
use Carbon\Carbon;

class SupervisorReportController extends Controller
{

    public function index(Request $request)
    {

        if (!auth()->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin') && !auth()
            ->user()
            ->hasRole('Staff')  && !auth()
            ->user()
            ->hasRole('Supervisor')) {
            abort(403, 'Unauthorized action.');
        }


        if (
            auth()->user()
            ->hasRole('Super Admin') || auth()
            ->user()
            ->hasRole('Admin') || auth()
            ->user()
            ->hasRole('Staff')
        ) {
            $query = SupervisorReport::has('user')->latest();

            if (!is_null($request->project_id)) {
                $query->whereHas('user.projects', function ($query) use ($request) {
                    $query->where('project_id', $request->project_id);
                });
            }


            if (!is_null($request->state_id)) {
                $query->where('state', $request->state_id);
            }

            // if (!is_null($request->lga_id)) {
            //     $query->where('lga', $request->lga_id);
            // }

            if (!is_null($request->status)) {
                $query->where('status', $request->status);
            }

            if ($request)
                return response()
                    ->json(['success' => true, 'data' => $query->paginate(20), 'message' => 'All reports', 'report_meta' => [
                        'Approved' => SupervisorReport::where('status', 'Approved')->get()->count(),
                        'Pending' => SupervisorReport::where('status', 'Pending')->get()->count(),
                        'Rejected' => SupervisorReport::where('status', 'Rejected')->get()->count(),
                        'Queried' => SupervisorReport::where('status', 'Queried')->get()->count(),
                        'Total' => SupervisorReport::all()->count()
                    ]], 200);
        } elseif (auth()
            ->user()
            ->hasRole('Supervisor')
        ) {

            $query = SupervisorReport::has('user')->where('user_id', auth()
                ->user()->id)->latest();

            if (!is_null($request->project_id)) {
                $query->whereHas('user.projects', function ($query) use ($request) {
                    $query->where('project_id', $request->project_id);
                });
            }

            if (!is_null($request->state_id)) {
                $query->where('state', $request->state_id);
            }

            // if (!is_null($request->lga_id)) {
            //     $query->where('lga_id', $request->lga_id);
            // }

            if (!is_null($request->status)) {
                $query->where('status', $request->status);
            }
            return response()
                ->json(['success' => true, 'data' => $query->paginate(20)->paginate(20), 'message' => 'All reports', 'report_meta' => [
                    'Approved' => SupervisorReport::where('user_id', auth()->user()->id)->where('status', 'Approved')->get()->count(),
                    'Pending' => SupervisorReport::where('user_id', auth()->user()->id)->where('status', 'Pending')->get()->count(),
                    'Rejected' => SupervisorReport::where('user_id', auth()->user()->id)->where('status', 'Rejected')->get()->count(),
                    'Queried' => SupervisorReport::where('user_id', auth()->user()->id)->where('status', 'Queried')->get()->count(),
                    'Total' => SupervisorReport::where('user_id', auth()->user()->id)->get()->count()
                ]], 200);
        }
    }

    public function create(Request $request)
    {



        if (!auth()
            ->user()
            ->hasRole('Supervisor')) {
            abort(403, 'Unauthorized action (Requires Supervisor role for Access).');
        }


        $user = \App\Models\User::find(auth()->user()->id);

        if (!$user->supervisorstate()->exists()) {
            return response()->json(['error' => true, 'data' => null, 'message' => "Supervisors cannot create reports before being assigned to a state."], 403);
        }

        $validatedData = $request->validate([
            // 'nos' => 'required|string|max:255',
            // 'submitted' => 'required|date',
            'geo_zone' => 'required|string|max:255',
            'state' => 'required|integer',
            // 'lga' => 'required|integer',
            'rsc' => 'required|string|max:255',
            'sos' => 'required|boolean',
            'location' => 'required|string|max:255',
            'nfsos' => 'required|string|max:255',
            'nwos' => 'required|integer',
            'now' => 'required|string|max:255',
            'rating' => 'required|integer',
            'npw' => 'required|integer',
            'gtw' => 'required|boolean',
            'eqw' => 'required|boolean',
            'wgatm' => 'required|string|max:255',
            'envsor' => 'required|integer',
            'or' => 'required|string|max:255',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['status'] = 'Pending';
        $validatedData['uuid'] = Uuid::uuid4();
        $validatedData['submitted'] = Carbon::now();
        $validatedData['name'] = $request->user()->name;

        $report = SupervisorReport::create($validatedData);

        return response()
            ->json(['success' => true, 'data' => $report, 'message' => 'Report Created'], 200);
    }


    public function getSupervisorReport(Request $request, $report_id)
    {

        if (!auth()->user()
            ->hasRole('Super Admin') && !auth()
            ->user()
            ->hasRole('Admin') && !auth()
            ->user()
            ->hasRole('Staff')  && !auth()
            ->user()
            ->hasRole('Supervisor')) {
            abort(403, 'Unauthorized action.');
        }


        $report = SupervisorReport::findOrFail($report_id);

        if (
            auth()
            ->user()
            ->hasRole('Supervisor') &&  $report->user_id !== auth()->user()->id
        ) {
            // abort(403, 'Unauthorized action (You do not own this report).');
        }
        return response()
            ->json(['success' => true, 'data' => $report, 'message' => 'Supervisor Report'], 200);
    }
}
