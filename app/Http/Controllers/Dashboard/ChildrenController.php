<?php

namespace App\Http\Controllers\Dashboard;

use App\Activity;
use App\BaseHeightPerAge;
use App\BaseImtPerAge;
use App\BaseWeightPerAge;
use App\Http\Controllers\Controller;
use App\Http\Traits\ActivityHelper;
use Illuminate\Http\Request;
use App\Family;
use App\Religion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Children;

class ChildrenController extends Controller
{
    use ActivityHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // $families = Family::get();
        $childrens = Children::with('family')->get();
        return view('dashboard.children.index', compact('childrens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $agamas = Religion::get();
        $families = Family::get();
        return view('dashboard.children.create', compact('agamas', 'families'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pasangan' => 'required',
            'agama' => 'required|exists:religions,id',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $children = Children::create([
                'family_id' => $request->pasangan,
                'religion_id' => $request->agama,
                'name' => $request->nama,
                'birth_place' => $request->tempat_lahir,
                'birth_date' => Carbon::createFromFormat("d/m/Y", $request->tanggal_lahir),
                'gender' => $request->jenis_kelamin
            ]);

            $a = Activity::create([
                'child_id' => $children->id,
                'weight' => $request->berat_lahir,
                'height' => $request->panjang_lahir,
                'status' => '1',
                'age' => 0,
                'notes' => 'Bayi Lahir'
            ]);

            DB::commit();
            toastr()->success("Data berhasil ditambahkan");
        } catch (\Exception $exception) {
            DB::rollBack();
            toastr()->error("Data Gagal Ditambahkan, ", $exception->getMessage());
            // dd($exception);
        }

        return redirect()->route('dashboard.children.index');

    }

    /**
     * Display the specified resource.
     *
     * @param Children $children
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Children $children)
    {
        // Langsung return view dengan parameter children
        $father = $children->family->father;
        $mother = $children->family->mother;
        $activities = $children->activities;
        $gender = $children->gender == 1 ? 'P' : 'L';

        // Check Cache and get database
        $base_bb_per_u = Cache::get('base_bb_per_u_' . $gender);
        if(is_null($base_bb_per_u)){
            $base_bb_per_u = BaseWeightPerAge::where('gender', $gender)->whereIn('line', [3, 4, 5])->get();
            Cache::forever('base_bb_per_u_' . $gender, $base_bb_per_u);
        }

        $base_tb_per_u = Cache::get('base_tb_per_u_' . $gender);
        if(is_null($base_tb_per_u)){
            $base_tb_per_u = BaseHeightPerAge::where('gender', $gender)->whereIn('line', [3, 4, 5])->get();
            Cache::forever('base_tb_per_u_' . $gender, $base_tb_per_u);
        }

        $base_imt = Cache::get('base_imt_' . $gender);
        if(is_null($base_imt)){
            $base_imt = BaseImtPerAge::where('gender', $gender)->whereIn('line', [3, 4, 5])->get();
            Cache::forever('base_imt_' . $gender, $base_imt);
        }

        $chart_data = Cache::get('chart_data_' . $gender);
        if(is_null($chart_data)){
            $chart_data = [];
            $base_wpa = Cache::get('base_wpa_' . $gender);
            if(is_null($base_wpa)){
                $base_wpa = BaseWeightPerAge::where('gender', $gender)->get()->groupBy('month');
                Cache::forever('base_wpa_' . $gender, $base_wpa);
            }
            foreach ($base_wpa as $key => $wpa){
                $temp = array_reverse($wpa->pluck('value')->toArray());
                array_unshift($temp, $key);
                array_push($temp, null);
                array_push($chart_data, $temp);
            }

            Cache::forever('chart_data_' . $gender, $chart_data);
        }

        foreach ($activities as $index => $activity) {
            $activity->bb_per_u = number_format($activity->weight, 2);
            $activity->tb_per_u = number_format($activity->height, 2);
            $activity->bb_per_tb = number_format($activity->weight / $activity->height, 2);
            $activity->imt = number_format($activity->weight / (($activity->height / 100) * ($activity->height / 100)), 2);

            $value_bb_per_u = $this->calculateBaseValueByAge($activity->bb_per_u, $base_bb_per_u, $activity->age);
            $activity->status_bb_per_u = $this->getWeightPerAgeStatus($value_bb_per_u);

            $value_tb_per_u = $this->calculateBaseValueByAge($activity->tb_per_u, $base_tb_per_u, $activity->age);
            $activity->status_tb_per_u = $this->getHeightPerAgeStatus($value_tb_per_u);

            $value_imt = $this->calculateBaseValueByAge($activity->imt, $base_imt, $activity->age);
            $activity->status_imt = $this->getImtPerAgeStatus($value_imt);

            $chart_data[$activity->age][8] = $activity->weight;
        }

        array_unshift($chart_data, ["Bulan", "3SD", "2SD", "1SD", "SD", "-1SD", "-2SD", "-3SD", "Data Anak"]);

        return view('dashboard.children.show', compact('children', 'father', 'mother', 'activities', 'chart_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Children $children
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Children $children)
    {
        $agamas = Religion::get();
        $families = Family::get();
        return view('dashboard.children.edit', compact('children', 'agamas', 'families'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Children $children)
    {
        $this->validate($request, [
            'pasangan' => 'required',
            'agama' => 'required|exists:religions,id',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required'
        ]);
        try {
            DB::beginTransaction();

            $children->update([
                'family_id' => $request->pasangan,
                'religion_id' => $request->agama,
                'name' => $request->nama,
                'birth_place' => $request->tempat_lahir,
                'birth_date' => Carbon::createFromFormat("d/m/Y", $request->tanggal_lahir),
                'gender' => $request->jenis_kelamin
            ]);


            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            // dd($exception);
        }
        toastr()->success("Data berhasil diupdate");
        return redirect()->route('dashboard.children.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
