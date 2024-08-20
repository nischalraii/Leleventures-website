<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Files;
use App\Helper\Reply;
use App\Models\Partner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StorePartner;
use App\Http\Requests\UpdatePartner;

class PartnerController extends AdminBaseController
{
    //
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('menu.partner');
        $this->pageIcon = 'icon-people';
    }

    public function index()
    {
        //
        return view('admin.partner.index',$this->data);
    }


    public function create()
    {
        //
        abort_if(! $this->user->cans('add_partner'), 403);
    
        return view('admin.partner.create',$this->data);
    }

    public function store(StorePartner $request){
        
        abort_if(! $this->user->cans('add_partner'), 403);

        $partner = new Partner;
        $partner->name = $request->name;
        if ($request->hasFile('image')) {
            $partner->image = Files::uploadLocalOrS3($request->image,'partners');
        }
        $partner->slug = $request->slug;
        $partner->url = $request->url;

        $partner->save();

      

        return Reply::redirect(route('admin.partner.index'), __('menu.partner').' '.__('app.messages.createdSuccessfully'));
    }

    public function edit($id){
        abort_if(! $this->user->cans('edit_partner'), 403);
        $this->partnerData = Partner::find($id);
     
        return view('admin.partner.edit', $this->data);
    }

    public function update(UpdatePartner $request, $id){
      

        $partner = Partner::find($id);
        $partner->name = $request->name;
        if ($request->hasFile('image')) {
            $partner->image = Files::uploadLocalOrS3($request->image,'partners');
        }/*else{
            Files::deleteFile($slider->image, 'profile');
           $slider->image = null;
        }*/
        $partner->slug = $request->slug;
        $partner->url = $request->url;
        $partner->save();

       


        return Reply::redirect(route('admin.partner.index'), __('menu.partner').' '.__('app.messages.updatedSuccessfully'));
    }

    public function destroy($id)
    {
        //
        // abort_if(! $this->user->cans('delete_user'), 403);
        abort_if(! $this->user->cans('delete_partner'), 403);

        Partner::destroy($id);
   
        return Reply::success(__('app.messages.recordDeleted'));
    }


    public function data()
   {

    $partners = Partner::all();

       return DataTables::of($partners)
              ->addColumn('action', function ($row) {
           // Actions for menus
           $action = '<a href="' . route('admin.partner.edit', [$row->id]) . '" class="fs-5"
               data-toggle="tooltip" onclick="this.blur()" data-original-title="'.__('app.edit').'"><i class="fa fa-edit" aria-hidden="true"></i>   &nbsp &nbsp</a>';

           $action .= ' <a href="javascript:;" class="text-danger sa-params fs-5"
               data-toggle="tooltip" onclick="this.blur()" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i class="fa fa-times" aria-hidden="true"> </i></a>';

           return $action;
       })

       ->rawColumns(['name','image','slug','url','action'])
       ->addIndexColumn()
       ->make(true);

   }

}
