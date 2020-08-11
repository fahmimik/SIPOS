<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Parents;
use App\Pregnant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PregnantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pregnants = Pregnant::get();
        return view('dashboard.pregnant.index', compact('pregnants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $parents = Parents::where('gender', '1')->get();
      return view('dashboard.pregnant.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
          'nama_ibu' => 'required',
          'tanggal_kunjungan' => 'required',
          'kehamilan_ke' => 'required|numeric',
          'lila' => 'required|numeric',
          'berat' => 'required|numeric',
          'umur_kehamilan' => 'required|numeric',
          'pil_darah' => 'required|numeric',
          'imunisasi' => 'nullable',

      ]);
      try {
        DB::beginTransaction();

        $pregnants = Pregnant::create([
          'parent_id' => $request->nama_ibu,
          'created_at' => Carbon::createFromFormat("d/m/Y", $request->tanggal_kunjungan),
          'number_of_pregnant' => $request->kehamilan_ke,
          'lila' => $request->lila,
          'weight' => $request->berat,
          'pregnant_age' => $request->umur_kehamilan,
          'blood_pill' => $request->pil_darah,
          'tetanus_immunization' => $request->imunisasi
        ]);

        DB::commit();

      } catch (\Exception $exception) {
        DB::rollBack();
        dd($exception);
      }
      toastr()->success("Data berhasil ditambahkan");

      return redirect()->route('dashboard.pregnant.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pregnant $pregnant)
    {
      // dd($pregnants);
      $parents = Parents::where('gender', '1')->get();
      return view('dashboard.pregnant.edit', compact('pregnant', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pregnant $pregnant)
    {
      $this->validate($request, [
          'nama_ibu' => 'required',
          'tanggal_kunjungan' => 'required',
          'kehamilan_ke' => 'required|numeric',
          'lila' => 'required|numeric',
          'berat' => 'required|numeric',
          'umur_kehamilan' => 'required|numeric',
          'pil_darah' => 'required|numeric',
          'imunisasi' => 'nullable'
      ]);
      try {
        DB::beginTransaction();

        $pregnant->update([
          'parent_id' => $request->nama_ibu,
          'created_at' => Carbon::createFromFormat("d/m/Y", $request->tanggal_kunjungan),
          'number_of_pregnant' => $request->kehamilan_ke,
          'lila' => $request->lila,
          'weight' => $request->berat,
          'pregnant_age' => $request->umur_kehamilan,
          'blood_pill' => $request->pil_darah,
          'tetanus_immunization' => $request->imunisasi
        ]);


        DB::commit();
      } catch (\Exception $exception) {
        DB::rollBack();
        // dd($exception);
      }
      toastr()->success("Data berhasil diupdate");
      return redirect()->route('dashboard.pregnant.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Pregnant $pregnant)
     {
         $pregnant->delete();
         toastr()->success("Data berhasil dihapus");
         return redirect()->route('dashboard.pregnant.index');
     }
}
