<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function home()
    {
        return view('landingPage.home');
    }
    public function aboutus()
    {
        return view('landingPage.aboutus');
    }
    public function faq()
    {
        return view('landingPage.faq');
    }
    public function privacyPolicy()
    {
        return view('landingPage.privacyPolicy');
    }
    public function termsAndConditions()
    {
        return view('landingPage.termsAndConditions');
    }
    public function contactus()
    {
        return view('landingPage.contactus');
    }
     public function success()
    {
        return view('landingPage.success');
    }

    public function submitContactForm(Request $request)
{
    // Validate the form
    // $request->validate([
    //     'name' => 'required|max:100',
    //     'email' => 'required|email:rfc,dns',
    //     'phone' => 'required|numeric|digits_between:10,15',
    //     'subject' => 'required|max:150',
    //     'message' => 'required',
    // ]);
    
    
    
    
    $request->validate([
    'name' => 'required|max:100',
    'email' => 'required|email:rfc,dns',
    'phone' => 'required|numeric|digits_between:10,15',
    'subject' => 'required|max:150',
    'message' => 'required',
], [
    'phone.required' => 'The phone number field is required',
    'phone.numeric' => 'The phone field must be a number',
    'phone.digits_between' => 'The phone field must be between 10 and 15 digits',
]);
    
    
    
    
    
    
    

    // Send email using request values directly
    Mail::send('emails.contact_form', [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'subject' => $request->subject,
        'messageText' => $request->message, // avoid naming conflict
    ], function ($message) use ($request) {
        $message->to('support@winngoocoin.com'); // replace with your email
        $message->subject('New Contact Form Submission');
    });

    return back()->with('success', 'Form submitted successfully!');
}
}
