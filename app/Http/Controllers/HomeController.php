<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailQueue;
use App\User;
use Illuminate\Http\Request;
use Validator;

class HomeController extends Controller
{

    public function index() {
        $emails = User::all()->pluck('name','email');
        return view('welcome',compact('emails'));
    }
    /**
     * Display a listing of the emails.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emails' => 'required',
        ]);
        if ($validator->passes()) {
            foreach ($request->emails as $email) {
                $storagePath = public_path('upload/attachFile.pdf');
                dispatch(new SendEmailQueue($email,$storagePath));
            }
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function emailList(Request $request)
    {
        $formatted_tags = [
            ['id' => 'haresh.sisodiya@viitor.cloud', 'text' => 'haresh'],
            ['id' => 'devat.sisodiya@viitor.cloud', 'text' => 'devat'],
            ['id' => 'dhaval.sisodiya@viitor.cloud', 'text' => 'dhaval'],
        ];

        return \Response::json($formatted_tags);
    }
}
