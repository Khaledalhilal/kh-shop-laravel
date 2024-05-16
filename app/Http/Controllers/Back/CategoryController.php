<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Category;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{

    public function index()
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $getAllCategories = Category::getAllCategories();
        $id = $adminSession['id'];
        $user = User::find($id);
        return view('Back.category', compact('getAllCategories', 'user'));
    }



    public function store(Request $request)
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }

        $validator = $request->validate([
            'name' => 'required | min:2 | max:30',
            'my_work' => 'required',
        ]);


        $catName = $request->name;

        $existingCategory = Category::where('name', $catName)->first();
        if ($existingCategory) {

            return response()->json([
                'status' => 'error',
                'message' => 'Category name already exists, Please Try again',
            ]);
        } else {

            $categoryName = $request->name;
            $imageName = $categoryName . '_' . time() . '.' . $request->file('my_work')->extension();
            $request->file('my_work')->storeAs('Back/img/category', $imageName, 'back-img-category');
            $category = Category::create([
                'name' => $categoryName,
                'image' => $imageName,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category Added successfully',
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
        $catName = $request->name;
        $image = $request->hasFile('my_work');
        $categories = Category::findOrFail($id);
        $existingCategory = Category::where('name', $catName)->where('id', '!=', $id)->first();

        if ($existingCategory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category name already exists. Please try again.',
            ]);
        }

        $validator = $request->validate([
            'name' => 'required|min:2|max:30',
        ]);

        if ($image && $catName) {
            $imageName = $catName . '_' . time() . '.' . $request->file('my_work')->extension();
            $request->file('my_work')->storeAs('Back/img/category', $imageName, 'back-img-category');
            $categories->update([
                'name' => $catName,
                'image' => $imageName,
            ]);
        } elseif ($image) {
            $imageName = $categories->name . '_' . time() . '.' . $request->file('my_work')->extension();
            $request->file('my_work')->storeAs('Back/img/category', $imageName, 'back-img-category');
            $categories->update([
                'image' => $imageName,
            ]);
        } elseif ($catName) {
            $categories->update([
                'name' => $catName,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Category updated successfully',
        ]);
    }



    public function destroy(string $id)
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        try {
            $deleted = Category::where('id', $id)->delete();
            if ($deleted) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please try again',
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
