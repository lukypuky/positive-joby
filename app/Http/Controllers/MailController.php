<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use App\Mail\ContactMailToPositive;
use App\Mail\ContactMailToUser;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\Job;

class MailController extends Controller
{
    public function sendMail(Request $request){

        if($request->get('job')){
            $job = Job::where('id', $request->get('job'))->firstOrfail();

            $data = [
                'nameSurname' => $request->get('nameSurname'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'message' => $request->get('message'),
                'job' => $job,
                'file' => $request->file('fileUpload')
            ];
        }
        else{
            $data = [
                'nameSurname' => $request->get('nameSurname'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'message' => $request->get('message'),
                'file' => $request->file('fileUpload')
            ];
        }

        $request->validate([
            'nameSurname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:8'],
            'email' => ['required', 'string', 'email', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', 'max:255'],
            'message' => ['required', 'min:6'],
            'conditions' => 'required',
        ]);

        if($request->file('fileUpload')){
            if($request->file('fileUpload')->getSize() > 10000000){
                return Redirect::back()->with('failEmail', 'Príloha musí mať menej ako 10MB.');
            }
        }

        $email = 'lukash.baca@gmail.com'; //docasne
        \Mail::to("$email")->send(new ContactMailToPositive($data));
        \Mail::to("$request->email")->send(new ContactMailToUser($data));

        Contact::create([
            'contact_type' => $request->get('formType'), 
            'id_job' => $request->get('job'),
            'name_surname' => $request->get('nameSurname'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'message' => $request->get('message'),
        ]);

        if($request->get('formType') == 1){
            return Redirect::back()->with('successJobEmail', 'Vaša žiadosť bola úspešne odoslaná.');
        }
        else{
            return Redirect::back()->with('successEmail', 'Vaša správa bola úspešne odoslaná.');
        }

    }
}
