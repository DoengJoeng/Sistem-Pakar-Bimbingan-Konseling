<?php

namespace App\Http\Controllers;
use App\Models\Konselling;
use App\Models\Bimbingan;
use App\Models\Gejala;
use App\Models\Relasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonsellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konselling =DB::table('konselling')->paginate(5);
        $relasi = Relasi::all();
        $gejala = Gejala::all();
        $permasalahan = Permasalahan::all();
        return view('Konselling.index', compact('konselling', 'relasi', 'gejala', 'permasalahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function selectGejala($bimbingan_id) {
        $gejala = Gejala::all();
        return view('konselling.create', compact('gejala', 'bimbingan_id'));
    }

    public function create()
    {   
        $bimbingan_id = DB::table('tmpGejala')->get();
        $gejala = Gejala::all();
        return view('konselling.create', compact('gejala', 'bimbingan_id'));   
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
            'gejala' => 'required'
        ]);
        
        // Menggambil nilai dari form gejala
        $data = $request->all();
        $gejala = $data['gejala'];
        // dd($gejala);    

        $relasi = Relasi::select('permasalahan_id')
            ->whereIn('gejala_id', $gejala)
            ->groupBy('permasalahan_id')
            ->get();
        dd($relasi);

        foreach ($relasi as $key => $value) {
            $permasalahan[] = $value->permasalahan_id;
        }
        // Menampilkan nilai pada Relasi
        dd($permasalahan);

        foreach ($permasalahan as $key => $value){
            // dd($value);
            $count = 0;
            foreach ($gejala as $k => $v) {
                $cek = Relasi::select('permasalahan')
                    ->where([
                        ['permasalahan_id', '=', $value],
                        ['gejala_id', '=', $v],
                    ])->get();
                // dd($value);
                // dd($gejala);

                if(!$cek->isEmpty()){
                    $permasalahan[$value][] = $cek;
                    dd($permasalahan);
                }
               
            }
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
