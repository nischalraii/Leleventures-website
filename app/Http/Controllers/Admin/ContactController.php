<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreContact;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Helper\Reply;
class ContactController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('menu.contact');
        $this->pageIcon = 'icon-people';
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // abort_if(! $this->user->cans('view_contact'), 403);
        $this->contact = Contact::all();
        return view('admin.contact.index', $this->data);
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
   public function store(StoreContact $request)
    {
        abort_if(! $this->user->cans('add_contact'), 403);

        $contact = new Contact;
        $contact->name = $request->name;
     
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        $contact->save();
        //Mail::to('info@leleventures.com')->send(new ContactMail($contact));
        Mail::send([], [], function ($message) use ($contact) {
            $message->to('info@leleventures.com')
                    ->subject($contact->subject)
                    ->html('Name: ' . $contact->name . '<br>' . 'Message: ' . $contact->message); 
        });
      
    // return redirect()->back()
    //                      ->with(['success' => 'Thank you for contact us. we will contact you shortly.']);
        return Reply::redirect(route('admin.contact.index'), _('menu.contact').' '._('app.messages.createdSuccessfully'));
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
        // abort_if(! $this->user->cans('delete_user'), 403);
        // abort_if(! $this->user->cans('delete_contact'), 403);

        Contact::destroy($id);
   
        return Reply::success(__('app.messages.recordDeleted'));
    }

    public function data()
    {
 
     $contact = Contact::all();
 
        return DataTables::of($contact)
               ->addColumn('action', function ($row) {
            // Actions for menus
            $action = '<a href="' . route('admin.menu.edit', [$row->id]) . '" class="fs-5"
                data-toggle="tooltip" onclick="this.blur()" data-original-title="'.__('app.edit').'"><i class="fa fa-edit" aria-hidden="true"></i>   &nbsp &nbsp</a>';
 
            $action .= ' <a href="javascript:;" class="text-danger sa-params fs-5"
                data-toggle="tooltip" onclick="this.blur()" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i class="fa fa-times" aria-hidden="true"> </i></a>';
 
            return $action;
        })
 
        ->rawColumns(['name','email','subject','message','action'])
        ->addIndexColumn()
        ->make(true);
 
    }
}
