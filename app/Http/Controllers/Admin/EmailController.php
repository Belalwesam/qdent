<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Genreal;
use App\Model\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function index(Request $request)
    {
        $page_title = 'الحملات البريدية';
        $page_description = 'جدول بقائمة البريد الإلكتروني ';
        $emails = Email::orderBy('id','desc')->paginate(15);
        if($request->ajax())
        {

            return view('admin.email.table', compact('emails'))->render();
        }
        return view('admin.email.datatables', compact('page_title', 'page_description','emails'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status =  \Mail::to($request->email)
            ->send(new Genreal($request->title,$request->msg));


            return response()->json([
                'status'  => true,
                'message' => 'تم ارسال بريد بنجاح',
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        $page_title = 'إرسال بريد  ';
        $page_description = 'إرسال بريد  ';
        return view('admin.email.catEdit', compact('page_title', 'page_description','email'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
