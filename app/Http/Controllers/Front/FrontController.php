<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContact;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
class FrontController extends FrontBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
        return view('front.index', $this->data);
    }
public function contact(Request $request)
    {
        // abort_if(! $this->user->cans('add_contact'), 403);

        $contact = new Contact;
        $contact->name = $request->name;
     
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        $contact->save();
        //Mail::to('info@leleventures.com')->send(new ContactMail($contact));
        Mail::send([], [], function ($message) use ($contact) {
            $message->to('jamunagrg98@gmail.com')
                    ->subject($contact->subject)
                    ->html('Name: ' . $contact->name . '<br>' . 'Message: ' . $contact->message); 
        });
      
     return redirect()->back()
                         ->with(['success' => 'Thank you for contact us. we will contact you shortly.']);

        // return Reply::redirect(route('admin.contact.index'), _('menu.contact').' '._('app.messages.createdSuccessfully'));
    }
   
}
