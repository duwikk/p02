<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kontak;
use App\Models\siswa;
use App\Models\jenis_kontak;
use Illuminate\Support\Facades\Session; 

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = siswa::paginate(5);
        $data_jkontak = jenis_kontak::paginate(5);
        
        return view('mastercontact', compact('data', 'data_jkontak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $siswa = siswa::find($id);
        $j_kontak = jenis_kontak::all();
        return view('tambahcontact', compact('siswa', 'j_kontak'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kontak = new Kontak; 
        $kontak->siswa_id = $request->siswa_id;
        $kontak->jenis_kontak_id = $request->jenis_kontak;
        $kontak->deskripsi = $request->deskripsi;
        $kontak->save();
        return redirect('mastercontact')->with('success', 'Contact Telah Ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontak = siswa::find($id)->kontak()->get();
        return view ('showcontact', compact('kontak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kontak = kontak::find($id);
        $j_contact = jenis_kontak::all();
        return view('editcontact', compact('kontak', 'j_contact'));
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
        $this->validate($request, [
            'jenis_kontak' => 'required',
            'deskripsi' => 'required|max:200'
        ]);

        $kontak = kontak::find($id);
        $kontak->jenis_kontak_id = $request->jenis_kontak_id;
        $kontak->deskripsi = $request->deskripsi;

        Kontak::find($id)->update($request->all());
        return redirect('/mastercontact')->with('success',
        'Contact Telah Di Edit');
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

    public function hapus($id)
    {
        $siswa = kontak::find($id)->delete();
        return redirect()->back()->with('success', 'Contact Berhasil Dihapus');
    }
}
