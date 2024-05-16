<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Brand;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class BrandController extends Controller
{
    public function __construct()
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
    }
    public function index()
    {

        $adminSession = session()->get('adminSession');
        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $getAllBrands = Brand::select('id', 'name')->get();
        $id = $adminSession['id'];
        $user = User::find($id);
        return view('Back.brand', compact('getAllBrands', 'user'));
    }


    public function store(Request $request)
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }

        $validator = $request->validate([
            'name' => 'required | min:2 | max:30',
        ]);


        $brandName = $request->name;

        $existingBrand = Brand::where('name', $brandName)->first();
        if ($existingBrand) {

            return response()->json([
                'status' => 'error',
                'message' => 'Brand is already exists, Please Try again',
            ]);
        } else {


            $category = Brand::create([
                'name' => $brandName
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Brand Added successfully',

            ]);
        }
    }

    public function update(Request $request, string $id)
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $id = $request->id;
        $brandName = $request->name;
        $brands = Brand::findorFail($id);
        $existingBrand = brand::where('name', $brandName)->where('id', '!=', $id)->first();
        if ($existingBrand) {
            return response()->json([
                'status' => 'error',
                'message' => 'Brand is already exists, Please Try again',
            ]);
        } else {
            $validator = $request->validate([
                'name' => 'required | min:2 | max:30',

            ]);


            $updateCategory = $brands->update([
                'name' => $brandName,
            ]);



            return response()->json([
                'status' => 'success',
                'message' => 'Brand Updated successfully',

            ]);
        }
    }


    public function destroy(string $id)
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        try {
            $deleted = Brand::where('id', $id)->delete();
            if ($deleted) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'brand Deleted successfully',

                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please Try again',
                ]);
            }
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot delete the category because it is being referenced by other records.',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred. Please try again.',
                ]);
            }
        }
    }
}
