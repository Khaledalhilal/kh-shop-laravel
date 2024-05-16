<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Category;
use App\Models\Back\SubCategory;
use App\Models\Test;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $getAllCategories = Category::getAllCategories();
        $getAllSubCategories = SubCategory::with('category:id,name')->select('id', 'name', 'category_id', 'image')->get();
        $id = $adminSession['id'];
        $user = User::find($id);
        return view('Back.subCategory', compact('getAllSubCategories', 'getAllCategories', 'user'));
    }




    public function store(Request $request)
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }

        $validator = $request->validate([
            'subCategoryName' => 'required|min:2|max:30',
            'category_id' => 'required',
            'my_work' => 'required',
        ]);

        $subCatName = $request->subCategoryName;
        $categoryId = $request->category_id;

        $existingSubCategory = SubCategory::where('name', $subCatName)
            ->where('category_id', $categoryId)
            ->first();

        if ($existingSubCategory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sub Category already exists for this category.',
            ]);
        }

        //! If no existing subcategory found, proceed to create a new one
        $imageName = $subCatName . '_' . time() . '.' . $request->file('my_work')->extension();
        $request->file('my_work')->storeAs('Back/img/subCategory', $imageName, 'back-img-subCategory');

        $subCategory = SubCategory::create([
            'category_id' => $categoryId,
            'name' => $subCatName,
            'image' => $imageName,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Sub Category Added successfully',
        ]);
    }



    public function update(Request $request, string $id)
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $id = $request->id;
        $SubCatName = $request->name;
        $category_id = $request->category_id;
        $image = $request->hasFile('my_work');
        $subCategory = SubCategory::findorFail($id);
        $existingCategory = SubCategory::where('name', $SubCatName)->where('id', '!=', $id)->first();
        if ($existingCategory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sub Category name already exists, Please Try again',
            ]);
        } else {
            $validator = $request->validate([
                'name' => 'required | min:2 | max:30',
                'category_id' => 'required',

            ]);

            if ($image) {
                $categoryName = $request->name;
                $imageName = $categoryName . '_' . time() . '.' . $request->file('my_work')->extension();
                $request->file('my_work')->storeAs('Back/img/subCategory', $imageName, 'back-img-subCategory');
                $data = [
                    'name' => $categoryName,
                    'category_id' => $category_id,
                    'image' => $imageName,
                ];
                $subCat = $subCategory->update($data);
            } else {
                $subCategory->update([
                    'name' => $SubCatName,
                    'category_id' => $category_id,
                ]);
            }


            return response()->json([
                'status' => 'success',
                'message' => 'Sub Category Updated successfully',

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
            $deleted = SubCategory::where('id', $id)->delete();
            if ($deleted) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Sub Category Deleted successfully',

                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please Try again',
                ]);
            }
        } catch (QueryException $e) {
            //! Check if the exception is due to a foreign key constraint violation
            if ($e->errorInfo[1] == 1451) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot delete the sub category because it is being referenced by other records.',
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
