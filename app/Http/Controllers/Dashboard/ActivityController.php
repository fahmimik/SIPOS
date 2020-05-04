<?php

namespace App\Http\Controllers\Dashboard;

use App\Activity;
use App\BreastMilk;
use App\Children;
use App\Http\Controllers\Controller;
use App\Immunization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        for ($i = 0; $i < 10; $i++) {
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
        // Get list of year from global list above
        $list_of_years = $this->list_of_years;
        // Return view with data
        return view('dashboard.activity.index', compact('list_of_months', 'list_of_ages', 'list_of_years'));
    }

    public function create()
    {
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

    public function store(Request $request)
    {
        // Validasi form
        $this->validate($request, [
            'child' => 'required|exists:childrens,id',
            'activity_date' => 'required',
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'immunizations' => 'array',
            'breast_milks' => 'array',
            'vitamin_a' => 'required'
        ]);

        try {
            // Init transaction
            DB::beginTransaction();
            // TODO Inserting to DB with logic
            $child = Children::with('activities')->find($request->child);
            $last_activity = $child->activities->last(); // ambil kegiatan posyandu yang terakhir
            if (is_null($last_activity)) { // Jika tidak ada kegiatan posyandu sama sekali maka status baru
                $activity = $child->activities()->create([ // Membuat kegiatan posyandu dengan status bari
                    'weight' => $request->weight,
                    'height' => $request->height,
                    'status' => 1,
                    'age' => 1,
                    'vitamin_a' => $request->vitamin_a,
                    'created_at' => Carbon::createFromFormat('d/m/Y', $request->activity_date),
                    'notes' => $request->note
                ]);

                // tambah data imunisasi sesuai pemeriksaan
                $activity->immunizations()->attach($request->immunizations);

                // tambah data asi sesuai pemeriksaan
                $activity->breastMilks()->attach($request->breast_milks);
            } else {
//                $age = Carbon::now()->lastOfMonth()->diffInMonths($child->birth_date); // ambil umur dari anak dalam bulan
                $age = $request->age;

                if($child->activities->where('age', $age)->count() > 0){
                    toastError('Bulan yang anda masukan sudah ada');
                    return redirect()->back()->withInput($request->toArray());
                }

                if ($age - $last_activity->age > 1) { // cek kehadiran dari selisih umur bayi sekarang dengan pemeriksaan terakhir
                    $status = '0'; // status tidak hadri dari pemeriksaan sebelumnya
                } else if ($request->weight > $last_activity->weight) { // cek selisih BB bayi dari pemeriksaan terakhir
                    $status = '2'; // status naik
                } else {
                    $status = '3'; // status turun
                }

                $activity = $child->activities()->create([
                    'weight' => $request->weight,
                    'height' => $request->height,
                    'status' => $status,
                    'age' => $age,
                    'vitamin_a' => $request->vitamin_a,
                    'created_at' => Carbon::createFromFormat('d/m/Y', $request->activity_date),
                    'notes' => $request->note
                ]);

                // tambah data imunisasi sesuai pemeriksaan
                $activity->immunizations()->attach($request->immunizations);

                // tambah data asi sesuai pemeriksaan
                $activity->breastMilks()->attach($request->breast_milks);
            }

            // Commit transaction
            DB::commit();

            // Buat notifikasi / alert
            toastSuccess('Data kegiatan berhasil dibuat');
        } catch (\Exception $exception) {
            // Rollback transaction
            DB::rollBack();
            dd($exception); // lihat errornya
        }
        return redirect()->back();
    }
}
