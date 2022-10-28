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
    
    public function create($id)
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
        $masage = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maximal :max karakter',
            'numeric' => ':attribute harus diisi angka',
            'mimes' => ':attribute harus bertipe foto'
        ];

        $this->validate($request, [
            // 'deskripsi' => 'required|min:10'
        ], $masage);

        kontak::create([
            'siswa_id' => $request->id_siswa,
            'jenis_kontak_id' => $request->jenis_kontak,
            'deskripsi' => $request->deskripsi
        ]);

        Session::flash('success', "Contact berhasil ditambahkan!!");
        return redirect('/mastercontact');

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
        return $kontak;
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
        $masage = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maximal :max karakter',
            'numeric' => ':attribute harus diisi angka',
            'mimes' => ':attribute harus bertipe foto'
        ];

        $this->validate($request, [
            // 'nama_p' => 'required|min:7|max:30',
            // 'deskripsi' => 'required|min:10'
        ], $masage);

        $kontak = kontak::find($id);
        $kontak->jenis_kontak_id = $request->jenis_kontak;
        $kontak->deskripsi = $request->deskripsi;

        $kontak->save();
        Session::flash('success', "kontak berhasil diupdate!!");
        return redirect('mastercontact');
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
        Session::flash('success', 'Contact Berhasil Dihapus');
        return redirect('/mastercontact');
    }
}
