<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\TestimonialRequest;
use App\Http\Resources\AdminResource\TestimonialResource;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    //
    public function index()
    {
        return view('admin.testimonial.index');
    }
    public function dataList(Request $request)
    {
        try {
            $testimonials = Testimonial::query()
                ->when($request->rating, fn ($q) => $q->where('rating', $request->rating))
                ->when($request->status, fn ($q) => $q->where('status', $request->status))
                ->paginate($request->per_page ?? 1);
            return TestimonialResource::collection($testimonials);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function store(TestimonialRequest $request)
    {
        try {
            DB::beginTransaction();
            $testimonial = new Testimonial();
            $testimonial->name = $request->name;
            $testimonial->designation = $request->designation;
            $testimonial->review = $request->review;
            $testimonial->rating = $request->rating;
            $testimonial->sorting_number = $request->sorting_number ? $request->sorting_number : 1;
            $testimonial->status = 'Active';
            $testimonial->create_by = adminUser()->id;

            if ($request->hasFile("image")) {

                $image_url = imageUploader(
                    $file = $request->file('image'),
                    $path = 'testimonial',
                    $width = 65,
                    $height = 65,
                    $old_image = $testimonial->image
                );

                $testimonial->image = $image_url;
            }

            $testimonial->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Testimonial successfully created'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $testimonial = Testimonial::query()
                ->findOrFail($id);
            return new TestimonialResource($testimonial);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(TestimonialRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->name = $request->name;
            $testimonial->designation = $request->designation;
            $testimonial->review = $request->review;
            $testimonial->rating = $request->rating;
            $testimonial->status = $request->status;
            $testimonial->create_by = adminUser()->id;
            $testimonial->sorting_number = $request->sorting_number ? $request->sorting_number : 1;

            if ($request->hasFile("image")) {

                $image_url = imageUploader(
                    $file = $request->file('image'),
                    $path = 'testimonial',
                    $width = 65,
                    $height = 65,
                    $old_image = $testimonial->image
                );

                $testimonial->image = $image_url;
            }

            $testimonial->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Testimonial successfully updated'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
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
            $testimonial = Testimonial::query()
                ->findOrFail($id);
            if ($testimonial->status == 'Active') {
                $testimonial->status = 'Inactive';
            } else {
                $testimonial->status = 'Active';
            }
            $testimonial->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Testimonial $testimonial->status Successfully Done",
            ]);
        } catch (\Exception $e) {
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
                        'message' => 'Testimonial Some Issue. You Can not continue This Action',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Testimonial Successfully Deleted",
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
        $testimonial = Testimonial::query()
            ->findOrFail($id);

        if ($testimonial->image) {
            fileUnlink($testimonial->image);
        }

        $testimonial->delete();

        return true;
    }
}
