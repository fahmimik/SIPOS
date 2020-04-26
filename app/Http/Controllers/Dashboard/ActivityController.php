<?php

namespace App\Http\Controllers\Dashboard;

use App\BreastMilk;
use App\Children;
use App\Http\Controllers\Controller;
use App\Immunization;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // List of ages of child
    private $list_of_ages = ['0 - 12 Bulan', '13 - 24 Bulan', '25 - 36 Bulan', '37 - 48 Bulan', '49 - 60 Bulan'];
    // List of month
    private $list_of_months = [];
    // List of year
    private $list_of_years = [];

    public function __construct()
    {
        // Generate List Of Month in controller constructor, ie : January, February, ...
        for ($i = 1; $i <= 12; $i++) {
            array_push($this->list_of_months, Carbon::createFromDate(null, $i)->format('F'));
        }

        // Generate List Of Year descending last 5 year in controller constructor, ie : 2020, 2019, 2018 ...
        for ($i = 0; $i < 5; $i++) {
            array_push($this->list_of_years, Carbon::createFromDate(date('Y') - $i)->format('Y'));
        }
    }

    // Page index of activity (KMS)
    public function index()
    {
        // Get list of ages from global list of age attribute above
        $list_of_ages = $this->list_of_ages;
        // Get list of months from global list of age attribute above
        $list_of_months = $this->list_of_months;
        // Return view with data
        return view('dashboard.activity.index', compact('list_of_months', 'list_of_ages'));
    }

    public function create(){
        // Get list of ages from global list of age attribute above
        $list_of_ages = $this->list_of_ages;
        // Get list of months from global list of age attribute above
        $list_of_months = $this->list_of_months;
        // Get list of years from global list of age attribute above
        $list_of_years = $this->list_of_years;

        // Get all child data from database
        $childs = Children::get();

        // Get all imunizations data from database
        $immunizations = Immunization::get();

        // Get all breast milk data from database
        $breast_milks = BreastMilk::get();
        // Return view with data
        return view('dashboard.activity.create', compact('list_of_months', 'list_of_years', 'list_of_ages', 'childs', 'immunizations', 'breast_milks'));
    }

    public function store(Request $request){
        // Validasi form
        $this->validate($request, [
            'child' => 'required|exists:childrens,id',
            'activity_date' => 'required',
            'age' => 'required',
            'month' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'immunizations' => 'required|array',
            'breast_milks' => 'required|array',
            'vitamin_a' => 'required'
        ]);

        // TODO Inserting to DB with logic

        return $request;
    }
}
