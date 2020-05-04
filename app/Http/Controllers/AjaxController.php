<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AjaxController extends Controller
{
    public function getActivities(Request $request)
    {
        $activities = Activity::with('children', 'immunizations');

        // Filter umur
        $age = $request->input('age');
        if ($age == 1) { // Umur 0 - 12 bulan
            $activities = $activities->whereBetween('age', [0, 12]); // pake eloquent wherebetween buat querynya
        } else if ($age == 2) { // Umur 13 - 24 bulan
            $activities = $activities->whereBetween('age', [13, 24]); // pake eloquent wherebetween buat querynya
        } else if ($age == 3) { // Umur 25 - 36 bulan
            $activities = $activities->whereBetween('age', [25, 36]); // pake eloquent wherebetween buat querynya
        } else if ($age == 4) { // Umur 37 - 48 bulan
            $activities = $activities->whereBetween('age', [37, 48]); // pake eloquent wherebetween buat querynya
        } else if ($age == 5) { // Umur 49 - 60 bulan
            $activities = $activities->whereBetween('age', [49, 60]); // pake eloquent wherebetween buat querynya
        }

        // Filter bulan
        $month = $request->input('month');
        if ($month != -1) { // cek dulu apakah valuenya bukan -1 (semua bulan)
            $activities = $activities->whereMonth('created_at', $month); // ambil data pake eloquent whereMonth atau filter by month
        }

        $year = $request->input('year');
        if ($year != -1) { // cek dulu apakah valuenya bukan -1 (semua tahun)
            $activities = $activities->whereYear('created_at', $year); // ambil data pake eloquent whereYear atau filter by year
        }

        /* Generate kolom dari yajra sesuai pada kolom di table
         * No
         * Nama
         * Tanggal
         * Berat
         * Panjang
         * Imunisasi
         * Keterangan
         * Action
         * */
        return DataTables::of($activities)
            ->addIndexColumn() // Tambah Kolom No sesuai index
            ->addColumn('_immunization', function ($activity) { // Tambah custom kolom imunisasi harus diawali dengan _ buat pembeda, parameternya activity
                $list_immunizations = $activity
                    ->immunizations
                    ->pluck('name') // ambil data imunisasi dari setiap activity dalam bentuk array
                    ->toArray(); // rubah dari bentuk collection ke bentuk array

                $immunization = implode(', ', $list_immunizations);  // dari data array tadi gabungkan ke bentuk string dipisah oleh koma
                return $immunization; // return string tadi
            })
            ->addColumn('_date', function($activity){ // Tambah custom kolom date dan harus diawali dengan _
                return $activity->created_at->format('d/m/Y'); // return date dari created at dengan format d/m/Y
            })
            ->addColumn('_action', function($activity){ // Tambah custom kolom action diwawali dengan _
                // actionnya nanti cuman edit dan detail

                // Action detail
                $detail_url = route('dashboard.children.show', $activity->children); // route ke detail anak, karena grafiknya disitu
                $detail = "<a href=\"$detail_url\" class=\"btn btn-sm btn-primary\"><i class=\"fa fa-info\"></i></a>";

                // Action edit
                $edit_url = route('dashboard.activity.edit', $activity); // route ke edit activity
                $edit = "<a class=\"btn btn-sm btn-success\" href=\"$edit_url\"><i class=\"fa fa-edit\"></i></a>"; // passing edit_url ke href

                return $detail . $edit; // return html detail sama edit tadi dan jangan lupa tambahkan ke rawColumns
            })
            ->rawColumns(['_action']) // semua kolom yang ada htmlnya wajib ditambahkan ke rawColumns
            ->make(true); // harus pake make true
        // Note : tadi cuman menambahkan 3 kolom, kolom lainnya itu sudah include datanya langsung,
        // cek http://localhost:8000/ajax/dashboard/activities?age=-1&year=-1&month=-1
    }
}
