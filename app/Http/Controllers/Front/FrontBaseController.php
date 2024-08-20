<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\CompanySetting;
use App\Models\Slider;

use App\Models\Menu;
use App\Models\About;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Services;
use Illuminate\Support\Facades\Cookie;

class FrontBaseController extends Controller
{
    /**
     * @var array
     */
    public $data = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */

    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[ $name ]);
    }

    public function __construct()
    {
        parent::__construct();
        $hash = request()->hash;
        $this->global = CompanySetting::first();
        $this->companyName = $this->global->company_name;
        $this->sliders = Slider::all();
    
  

        $this->menus = Menu::all();
        $this->about = About::all();
        $this->contact = Contact::all();

        $this->services = Services::all();
        $this->partners = Partner::all();
    }
}
