<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Helper\Reply;
use App\Http\Requests\StoreServices;
use App\Http\Requests\UpdateServices;
use App\Http\Requests\StoreServices;
use Google\Service\AppHub\Service;

class ServicesController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('menu.services');
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
        return view('admin.services.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        abort_if(! $this->user->cans('add_services'), 403);
    
        return view('admin.services.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServices $request)
    {
        //
        $data = new Services;
        $data->title = $request->title;
        $data->icon = $request->icon;
        $data->desc = $request->desc;
        $data->save();
        

        return Reply::redirect(route('admin.services.index'), __('menu.services').' '.__('app.messages.createdSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        abort_if(! $this->user->cans('edit_services'), 403);

        $this->serviceData = Services::find($id);
     
        return view('admin.services.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServices $request,$id)
    {
        //
        
        $service = Services::find($id);
        $service->icon = $request->icon;
        $service->title = $request->title;
        $service->desc = $request->desc;
    
        $service->save();

        return Reply::redirect(route('admin.services.index'), __('menu.services').' '.__('app.messages.updatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // abort_if(! $this->user->cans('delete_user'), 403);
        abort_if(! $this->user->cans('delete_services'), 403);

        Services::destroy($id);
   
        return Reply::success(__('app.messages.recordDeleted'));
    }

    public function data()
   {

    $services = Services::all();

       return DataTables::of($services)
              ->addColumn('action', function ($row) {
           // Actions for menus
           $action = '<a href="' . route('admin.services.edit', [$row->id]) . '" class="fs-5"
               data-toggle="tooltip" onclick="this.blur()" data-original-title="'.__('app.edit').'"><i class="fa fa-edit" aria-hidden="true"></i>   &nbsp &nbsp</a>';

           $action .= ' <a href="javascript:;" class="text-danger sa-params fs-5"
               data-toggle="tooltip" onclick="this.blur()" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i class="fa fa-times" aria-hidden="true"> </i></a>';

           return $action;
       })

       ->rawColumns(['icon','title','desc','action'])
       ->addIndexColumn()
       ->make(true);

   }

}
