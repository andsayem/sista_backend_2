<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Career;
use App\Mail\CareerMail;
use App\Http\Controllers\NotificationController;
use App\Myclass\PHPMailer;
use App\Myclass\SMTP; 

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['careers'] = Career::all();
       return view('career.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone_number' => 'required|size:11|regex:/(01)[0-9]{9}/',
            'email' => 'required|email',
            'year_of_experience' => 'nullable',
            'salary_expectation' => 'nullable',
            'link' => 'nullable',
            'comments' => 'nullable',
            'position' => 'required',
            'file' => 'required|mimes:doc,docx,pdf',
        ]);
        
        $data['cv'] = '';
        if ($request->has('file')) {
            $upload_path = public_path('resume');
            $file_name = $request->file->getClientOriginalName();
            $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move($upload_path, $generated_new_name);
            $data['cv'] = $generated_new_name;
        }
        
        $sender_address = $request->email;
        $sender_name = (!empty($request->name)) ? $request->name : $request->email;

        $receiver_name = env('APP_NAME');  
        $receiver_address = env('MAIL_USERNAME');

        try{
            DB::beginTransaction();
            Career::create($data);
            
            $phpMail = new PHPMailer();

            $phpMail->AddAddress($receiver_address, $receiver_name);
            $phpMail->AddReplyTo($receiver_address, $receiver_name);
            $message = view('component.career_mail_template')->with(['data' => $request]);
            
            $phpMail->FromName = $sender_name; 
            $phpMail->From = $sender_address;

            $phpMail->Sender= $sender_address;
            $phpMail->IsHTML(true);
            $phpMail->Host = "mail.ssgbd.com:25"; //your hostname such as ssgbd.com or ip
            $phpMail->IsSMTP();
            $phpMail->Mailer  = "smtp";
            $phpMail->Subject="Application for ".$request->position;
            $phpMail->Body=$message;  			
            $phpMail->SMTPAuth=false; 
            $phpMail->AddAttachment($upload_path.'/'.$generated_new_name);
            $phpMail->Send();

            $phpMail->ClearAddresses();
            $phpMail->ClearAttachments(); 
            
            NotificationController::resumeNotification();
            DB::commit();
            return response()->json(['message' => 'Thank you for submit your resume. We will contact you soon.'], 200);
        }catch(\Exception $e){
            return $e;
            DB::rollback();
        }
        return response()->json(['message' => 'Your application does not submit. Please try again.'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function download_resume($file)
    {
        return response()->download(public_path('resume/'.$file));
        return redirect()->back();
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
