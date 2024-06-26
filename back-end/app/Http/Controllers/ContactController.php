<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\ContactRequest;
use App\Imports\ContactsImport;
use App\Models\Contact;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function dashboard() {
        $totalUsers = Contact::where('user_id', auth()->id())->count();
        $categoryCounts = Contact::select('category', \DB::raw('count(*) as count'))
                        ->where('user_id', auth()->id())
                        ->groupBy('category')
                        ->get()
                        ->pluck('count', 'category');
        $activceCount = Contact::select('active', \DB::raw('count(*) as count'))
                        ->where('user_id', auth()->id())
                        ->groupBy('active')
                        ->get()
                        ->pluck('count', 'active')
                        ->mapWithKeys(function ($count, $active) {
                            return [$active ? 'activeCount' : 'notActiveCount' => $count];
                        });
        return response()->json([
            "status" => true,
            "message" => "User fatch successfully",
            "data" => compact('totalUsers', 'categoryCounts', 'activceCount')
        ], 200);
    }



    public function index()
    {
        // Response
        return response()->json([
            "status" => true,
            "message" => "User fatch successfully",
            "data" => Contact::where('user_id', auth()->id())->latest('id')->fillter(request(['search', 'active', 'category']))->paginate(request()->query('limit') ?? 10)
        ], 200);
    }

    public function store(ContactRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = auth()->id();

            // Simpan gambar
            $image = $request->file('image');
            if ($image) {
                $imageName = time() . '.' . $request->image->extension();
                $validated['image'] = Storage::url('images/' . $imageName);
            }
            
            // Save data
            Contact::create($validated);
            if ($image)  $request->image->storeAs('images', $imageName, 'public');
            return response()->json([
                "status" => true,
                "message" => "User create successfully",
            ], 201);
        } catch (\Throwable $th) {
            $status = method_exists($th, 'getStatusCode') ? $th->getStatusCode() : 500;
            $message = $th->getMessage();
        
            return response()->json([
                "status" => false,
                "message" => $message,
            ], $status);
        }
    }

    public function show(string $id)
    {
        $user = Contact::find($id);
        $this->authorize('view', $user);

        if ($user) {
            return response()->json([
                "status" => true,
                "message" => "User fatch successfully",
                "data" => $user
            ], 201);
        } else {
            return response()->json([
                "status" => true,
                "message" => "User Not found",
            ], 404);
        }
    }


    public function update(ContactRequest $request, string $id)
    {
        try {
            $user = Contact::findOrFail($id);
            $this->authorize('update', $user);
            
            // Retrieve the validated input data...
            $validated = $request->validated();

             $image = $request->file('image');
             if ($image) {
                 $imageName = time() . '.' . $request->image->extension();
                 $validated['image'] = Storage::url('images/' . $imageName);
                 $request->image->storeAs('images', $imageName, 'public');
                 Storage::delete(str_replace('/storage', 'public', $user->image));
             }
    
            // Save data
            $user->update($validated);
            
            return response()->json([
                "status" => true,
                "message" => "User update successfully",
            ], 201);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            // Tangani ketika klien tidak ditemukan
            return response()->json([
                "status" => false,
                "message" => "User not found.",
            ], 404);
        }
    }
    public function updateStatus(Request $request, string $id)
    {
        try {
            $user = Contact::findOrFail($id);
            $this->authorize('update', $user);

            $validated = $request->validate([
                'active' => ['required'],
            ]);

            $validated['active'] = $validated['active'] == 'true' ? 1 : 0;
            
            // Save data
            $user->update($validated);
            
            return response()->json([
                "status" => true,
                "message" => "User update successfully",
            ], 201);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            // Tangani ketika klien tidak ditemukan
            return response()->json([
                "status" => false,
                "message" => "User not found.",
            ], 404);
        } 
    }

    public function destroy(string $id)
    {
        try {
            $user = Contact::findOrFail($id);
            $this->authorize('delete', $user);


            $user->delete();
    
            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully',
            ], 201);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            // Tangani ketika klien tidak ditemukan
            return response()->json([
                "status" => false,
                "message" => "User not found.",
            ], 404);
        } 
    }

    public function export() 
    {
        return Excel::download(new UsersExport(request(['search', 'active', 'category'])), 'users.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new ContactsImport, $request->file('file'));

        return  response()->json([
            'status' => true,
            'message' => 'Contact import successfully',
        ], 201);
    }

    public function download()
    {
        $file_path = public_path(). "/files/template_import.xlsx";
        if (file_exists($file_path)) {
            return response()->download($file_path, 'template_import.xlsx');
        } else {
            abort(404, 'File not found');
        }

    }

}
