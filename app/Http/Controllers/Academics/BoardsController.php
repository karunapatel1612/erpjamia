<?php
namespace App\Http\Controllers\Academics;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use  Spatie\Permission\Models\Role;
use App\Models\Academics\AddUniversity;
use Illuminate\Support\Facades\Hash;
class BoardsController extends Controller
{

    public function index()
    {
        return view('academics.board.index');
    }
    public function addBoards()
    {
        return view('academics.board.add');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'university_type' => 'required|integer',
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
            'vertical' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg,pdf|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('University', 'public');
        }

        AddUniversity::create([
            'Is_Vocational' => $validatedData['university_type'],
            'Name' => $validatedData['name'],
            'Short_Name' => $validatedData['short_name'],
            'Vertical' => $validatedData['vertical'],
            'Address' => $validatedData['address'],
            'Logo' => $logoPath ?? null,
        ]);
        return response()->json(['message' => 'University added successfully!'], 201);
    }
}
