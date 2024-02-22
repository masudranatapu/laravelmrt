<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontedRequest\ContactRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Newsletter;
use App\Http\Requests\FrontedRequest\NewsletterRequest;

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

    public function contactStore(ContactRequest $request)
    {
        try {
            DB::beginTransaction();
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
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
    public function faq()
    {
        return view('frontend.pages.faq');
    }

    public function newsletter(NewsletterRequest $request)
    {
        try {
            DB::beginTransaction();

            $existEmail = Newsletter::where('email', $request->email)->first();

            if ($existEmail) {
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
