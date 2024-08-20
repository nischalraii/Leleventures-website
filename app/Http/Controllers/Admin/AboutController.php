<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Helper\Reply;
use App\Http\Requests\StoreAbout;
use App\Http\Requests\UpdateAbout;

class AboutController extends AdminBaseController
{
    //
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('menu.about');
        $this->pageIcon = 'icon-people';
    }

    public function index()
    {
        //
        return view('admin.about.index',$this->data);
    }

    public function create()
    {
        abort_if(! $this->user->cans('add_about'), 403);
    
        return view('admin.about.create',$this->data);
    }

    public function edit($id){
        abort_if(! $this->user->cans('edit_about'), 403);

        $this->aboutData  = About::find($id);
     
        return view('admin.about.edit', $this->data);
    }


    public function store(StoreAbout $request)
    {

        $data = new About;
        $data->desc = $request->desc;
        $data->save();
        
        return Reply::redirect(route('admin.about.index'), __('menu.about').' '.__('app.messages.createdSuccessfully'));

    }

    public function update(UpdateAbout $request, $id){
      
        $data = About::find($id);
        $data->desc = $request->desc;
        $data->save();

        return Reply::redirect(route('admin.about.index'), __('menu.about').' '.__('app.messages.updatedSuccessfully'));

    }


    public function destroy($id)
    {
        // abort_if(! $this->user->cans('delete_user'), 403);
        abort_if(! $this->user->cans('delete_about'), 403);

     About::destroy($id);
   
        return Reply::success(__('app.messages.recordDeleted'));
    }

    public function data()
   {

    $about = About::all();

       return DataTables::of($about)
              ->addColumn('action', function ($row) {
           $action = '<a href="' . route('admin.about.edit', [$row->id]) . '" class=" edit-menu"
               data-toggle="tooltip" onclick="this.blur()" data-original-title="'.__('app.edit').'"><i class="fa fa-edit fs-5" aria-hidden="true">&nbsp&nbsp</i></a>';

           $action .= ' <a href="javascript:;" class="text-danger sa-params"
               data-toggle="tooltip" onclick="this.blur()" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i class="fa fa-times fs-5" aria-hidden="true"></i></a>';

           return $action;
       })

       ->rawColumns(['desc','action'])
       ->addIndexColumn()
       ->make(true);

   }
}
