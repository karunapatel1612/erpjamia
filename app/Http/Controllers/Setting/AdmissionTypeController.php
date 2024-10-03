<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;

use App\Models\Setting\AdmissionType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class AdmissionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $admissionType = AdmissionType::all();
    //     // return view('setting.admissionType.index');
    //     return view('setting.admissionType.index', compact('admissionType'));

    // }

    // public function index(Request $request){

    //     if ($request->ajax()) {

    //         $data = AdmissionType::orderBy('id', 'desc')->get();

    //         return Datatables::of($data)
    //         ->addIndexColumn()

    //         ->editColumn('created_at', function ($data) {
    //         return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
    //         })
    //         ->make(true);
    //     }
    //     return view('setting.admissionType.index');

    // }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AdmissionType::orderBy('id', 'desc')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
                })
                ->make(true);
        }
        return view('setting.admissionType.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting.admissionType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',

        ]);
        try {
            $existingAdmissionType = AdmissionType::where('name', $validated['name'])->first();

            if ($existingAdmissionType) {
                return response()->json(['status' => '409', 'msg' => 'Admission Type already exists!'], 409);
            }
            $admissiontype = new AdmissionType;
            $admissiontype->name = $validated['name'];


            $admissiontype->save();
            return ['status' => 'success', 'message' => 'admission Added successfully!'];
        } catch (\Exception $e) {

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(AdmissionType $admissionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($admissionTypeId)
    {
        $admissionType = AdmissionType::findOrFail($admissionTypeId);

        return view('setting.admissionType.edit', compact('admissionType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $admissionTypeId)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $admissionType = AdmissionType::findOrFail($admissionTypeId);

            $admissionType->name = $validated['name'];
            $admissionType->save();

            return response()->json(['status' => 'success', 'message' => 'Admission Type updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($admissionTypeId)
    { {
            try {
                $admissionType = AdmissionType::destroy($admissionTypeId);
                return ['status' => 'success', 'message' => 'AdmissionType deleted successfully!'];
            } catch (\Throwable $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }

    public function status($id)
    {
        // if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-types')) {
        try {
            $admissionType = AdmissionType::findOrFail($id);
            if ($admissionType) {
                $admissionType->status = $admissionType->status == 1 ? 0 : 1;
                $admissionType->save();
                return response()->json([
                    'status' => 'success',
                    'message' => $admissionType->name . ' status updated successfully!',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'AdmissionType not found',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
