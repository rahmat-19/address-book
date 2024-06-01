<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function dashboard() {
        $totalUsers = User::count();
        $categoryCounts = User::select('category', \DB::raw('count(*) as count'))
                        ->groupBy('category')
                        ->get()
                        ->pluck('count', 'category');
        $activceCount = User::select('active', \DB::raw('count(*) as count'))
                        ->groupBy('active')
                        ->get()
                        ->pluck('count', 'active');
                         // Response
        return response()->json([
            "status" => true,
            "message" => "User fatch successfully",
            "data" => compact('totalUsers', 'categoryCounts', 'activceCount')
        ], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Response
        return response()->json([
            "status" => true,
            "message" => "User fatch successfully",
            "data" => User::latest()->fillter(request(['search', 'active', 'category']))->paginate(request()->query('limit') ?? 10)
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            // Retrieve the validated input data...
            $validated = $request->validated();
    
            // Save data
            User::create($validated);
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if ($user) {
            // User found
            return response()->json([
                "status" => true,
                "message" => "User fatch successfully",
                "data" => $user
            ], 201);
        } else {
            // User not found
            return response()->json([
                "status" => true,
                "message" => "User Not found",
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            // Retrieve the validated input data...
            $validated = $request->validated();
    
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
        } catch (\Throwable $th) {
            //throw $th;
            $status = method_exists($th, 'getStatusCode') ? $th->getStatusCode() : 500;
            $message = $th->getMessage();
        
            return response()->json([
                "status" => false,
                "message" => $message,
            ], $status);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

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
        } catch (\Throwable $e) {
            $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], $status); // Internal Server Error status code
        }
    }

    public function export() 
    {
        return Excel::download(new UsersExport(request(['search', 'active', 'category'])), 'users.xlsx');
    }
}
