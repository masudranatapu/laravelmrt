<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Newsletter;
use App\Http\Requests\NewsletterRequest;

class FrontendController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function service()
    {
        return view('frontend.pages.service');
    }

    public function testimonial()
    {
        return view('frontend.pages.testimonial');
    }
    public function team()
    {
        return view('frontend.pages.team');
    }
    
    public function newsletter(NewsletterRequest $request)
    {
        try {
            DB::beginTransaction();

            $existEmail = Newsletter::where('email', $request->email)->first();

            if($existEmail) {
                return response()->json([
                    'status' => false,
                    'message' => 'Newsletter already stored. Please try again with another email',
                ]);
            }

            $newsletter = new Newsletter();
            $newsletter->email = $request->email;
            $newsletter->save();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Newsletter successfully stored',
            ]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
