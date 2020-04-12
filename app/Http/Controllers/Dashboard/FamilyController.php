<?php

namespace App\Http\Controllers\Dashboard;

use App\Family;
use App\Parents;
use App\Http\Controllers\Controller;
use App\Religion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $families = Family::with('father', 'mother', 'childrens')->get();
        return view('dashboard.parents.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $agamas = Religion::get();
        return view('dashboard.parents.create', compact('agamas'));
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
            'nama_suami' => 'required|min:3|max:64',
            'nik_suami' => 'required|numeric',
            'tempat_lahir_suami' => 'required',
            'tanggal_lahir_suami' => 'required',
            'agama_suami' => 'required|exists:religions,id',
            'pekerjaan_suami' => 'required',
            'nama_istri' => 'required',
            'nik_istri' => 'required|numeric',
            'tempat_lahir_istri' => 'required',
            'tanggal_lahir_istri' => 'required',
            'agama_istri' => 'required|exists:religions,id',
            'pekerjaan_istri' => 'required',
            'no_kk' => 'required',
            'alamat_pasangan' => 'required',
            'tanggal_menikah' => 'required'
        ]);

        try {
            DB::beginTransaction();

           // return $request->agama_suami;

            $ayah = Parents::create([
                'religion_id' => $request->agama_suami,
                'name' => $request->nama_suami,
                'gender' => 2,
                'nik' => $request->nik_suami,
                'job' => $request->pekerjaan_suami,
                'birth_date' => Carbon::createFromFormat("d/m/Y", $request->tanggal_lahir_suami),
                'birth_place' => $request->tempat_lahir_suami
            ]);

            $ibu = Parents::create([
                'religion_id' => $request->agama_istri,
                'name' => $request->nama_istri,
                'gender' => 1,
                'nik' => $request->nik_istri,
                'job' => $request->pekerjaan_istri,
                'birth_date' => Carbon::createFromFormat("d/m/Y", $request->tanggal_lahir_istri),
                'birth_place' => $request->tempat_lahir_istri
            ]);

            $family = Family::create([
                'father_id' => $ayah->id,
                'mother_id' => $ibu->id,
                'married_at' => Carbon::createFromFormat("d/m/Y", $request->tanggal_menikah),
                'address' => $request->alamat_pasangan,
                'no_kk' => $request->no_kk
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            // dd($exception);
        }

        toastr()->success("User berhasil ditambahkan");

        return redirect()->route('dashboard.family.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Family $family
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Family $family)
    {
        return view('dashboard.parents.show', compact('family'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Family $family
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Family $family)
    {
        $agamas = Religion::get();
        return view('dashboard.parents.edit', compact('family', 'agamas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Family $family
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Family $family)
    {
        $this->validate($request, [
            'nama_suami' => 'required|min:3|max:64',
            'nik_suami' => 'required|numeric',
            'tempat_lahir_suami' => 'required',
            'tanggal_lahir_suami' => 'required',
            'agama_suami' => 'required|exists:religions,id',
            'pekerjaan_suami' => 'required',
            'nama_istri' => 'required',
            'nik_istri' => 'required|numeric',
            'tempat_lahir_istri' => 'required',
            'tanggal_lahir_istri' => 'required',
            'agama_istri' => 'required|exists:religions,id',
            'pekerjaan_istri' => 'required',
            'no_kk' => 'required',
            'alamat_pasangan' => 'required',
            'tanggal_menikah' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $family->father->update([
                'religion_id' => $request->agama_suami,
                'name' => $request->nama_suami,
                'gender' => 2,
                'nik' => $request->nik_suami,
                'job' => $request->pekerjaan_suami,
                'birth_date' => Carbon::createFromFormat("d/m/Y", $request->tanggal_lahir_suami),
                'birth_place' => $request->tempat_lahir_suami
            ]);

            $family->mother->update([
                'religion_id' => $request->agama_istri,
                'name' => $request->nama_istri,
                'gender' => 1,
                'nik' => $request->nik_istri,
                'job' => $request->pekerjaan_istri,
                'birth_date' => Carbon::createFromFormat("d/m/Y", $request->tanggal_lahir_istri),
                'birth_place' => $request->tempat_lahir_istri
            ]);

            $family->update([
                'married_at' => Carbon::createFromFormat("d/m/Y", $request->tanggal_menikah),
                'address' => $request->alamat_pasangan,
                'no_kk' => $request->no_kk
            ]);
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
        }

        toastr()->success("Data berhasil diupdate");
        return redirect()->route('dashboard.family.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Family $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
      $family->delete();
      toastr()->success("Data berhasil dihapus");
      return redirect()->route('dashboard.family.index');
    }
}
