<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackendRequest\CategoryRequest;
use App\Http\Resources\BackendResource\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.category.index');
    }

    public function list(Request $request)
    {
        try {
            $data = Category::query()
                ->when($request->keyword, fn ($q) => $q->where('name', 'like', '%' . $request->keyword . '%'))
                ->when($request->status, function ($q) use ($request) {
                    $q->where('status', $request->status);
                })
                ->paginate($request->per_page ?? 10);
            return CategoryResource::collection($data);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $category = new Category();
            $category->name = $request->name;
            $category->status = 'Active';
            $category->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Category Successfully Created",
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $data = Category::query()
                ->findOrFail($id);
            return new CategoryResource($data);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $category = Category::query()
                ->findOrFail($id);
            $category->name = $request->name;

            if ($request->hasFile("image")) {

                $image_url = imageUploader(
                    $file = $request->file('image'),
                    $path = 'business',
                    $width = 200,
                    $height = 200,
                    $old_image = $category->image
                );

                $category->image = $image_url;
            }

            $category->status = $request->status ? $request->status : $category->status;
            $category->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Category Successfully Updated",
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function statusChange($id)
    {
        try {
            DB::beginTransaction();
            $category = Category::query()
                ->findOrFail($id);
            if ($category->status == 'Active') {
                $category->status = 'Inactive';
            } else {
                $category->status = 'Active';
            }
            $category->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Category $category->status Successfully Done",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            DB::beginTransaction();
            $ids = explode(',', $request->ids);
            foreach ($ids as $id) {
                $deleteData = $this->destroy($id);
                if ($deleteData != true) {
                    DB::rollBack();
                    return response()->json([
                        'status' => false,
                        'message' => 'Some Category Used On Product Table. You Can not continue This Action',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Category Successfully Deleted",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        $category = Category::query()
            ->with('products')
            ->findOrFail($id);

        // if ($category->products->count() > 0) {
        //     return false;
        // } else {
        $category->delete();
        return true;
        // }
    }
}
