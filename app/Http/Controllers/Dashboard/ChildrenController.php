<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Family;
use App\Religion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Children;

class ChildrenController extends Controller
{
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


            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            // dd($exception);
        }
        toastr()->success("Data berhasil ditambahkan");

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
        return view('dashboard.children.show', compact('children', 'father', 'mother'));
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
