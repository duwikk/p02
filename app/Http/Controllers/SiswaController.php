<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\siswa;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = siswa::all();
        return view('mastersiswa' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambahsiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $massage=[
            'required' => ':attribute harus di isi',
            'min' => ':attribute min :min karakter',
            'max' => ':attribute min :max karakter',
            'numeric' => ':attribute di isi angka',
            'mimes' => 'file :attribute harus bertipe jpeg,jpg,png'
        ];


        //validasi form
        $this->validate($request,[
            'nama' => 'required|min:7|max:30',
            'nisn' => 'required|numeric',
            'alamat' => 'required',
            'jk' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg',
            'about'=> 'required|min:10'
        ], $massage);

        //ambil informasi file yang di upload 
        $file = $request->file('foto');

        //rename 
        $nama_file = time()."_".$file->getClientOriginalName();

        //press upload 
        $tujuan_upload = './template/img';
        $file->move($tujuan_upload, $nama_file);


        //insert data 
        siswa::create([
            'nama' => $request-> nama,
            'nisn' => $request-> nisn, 
            'alamat' => $request-> alamat,
            'jk' => $request-> jk,
            'foto' => $nama_file,
            'about'=> $request-> about
        ]);
        
        Session::flash('success', "Data Berhasil di Tambahkan");
        return redirect('/mastersiswa');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa=Siswa::find($id);
        $kontaks=$siswa->kontak()->get();
        return view('showsiswa', compact('siswa', 'kontaks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa=Siswa::find($id);
        return view('editsiswa', compact('siswa'));
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
        $massage=[
            'required' => ':attribute harus di isi',
            'min' => ':attribute min :min karakter',
            'max' => ':attribute min :max karakter',
            'numeric' => ':attribute di isi angka',
            'mimes' => 'file :attribute harus bertipe jpeg,jpg,png'
        ];


        //validasi form
        $this->validate($request,[
            'nama' => 'required|min:7|max:30',
            'nisn' => 'required|numeric',
            'alamat' => 'required',
            'jk' => 'required',
            'foto'=>'mimes:jpg,png,jpeg',
            'about'=> 'required|min:10'
        ], $massage);

        if($request->foto !=''){

        //Menghapus File foto lama 
        $siswa=Siswa::find($id);
        File::delete('./template/img/'.$siswa->foto);    

        //ambil informasi file foto baru yang di uploaded
        $file = $request->file('foto');

        //rename 
        $nama_file = time()."_".$file->getClientOriginalName();

        //press upload 
        $tujuan_upload = './template/img';
        $file->move($tujuan_upload, $nama_file);
          //menyimpan ke database
          $siswa->nama = $request->nama;
          $siswa->nisn = $request->nisn;
          $siswa->alamat = $request->alamat;
          $siswa->jk = $request->jk;
          $siswa->foto = $nama_file;
          $siswa->about = $request->about;
          $siswa->save();
          Session::flash('success', "Data Berhasil di Edit");
          return redirect('/mastersiswa');

        }else{
          $siswa=Siswa::find($id);
          $siswa->nama = $request->nama;
          $siswa->nisn = $request->nisn;
          $siswa->alamat = $request->alamat;
          $siswa->jk = $request->jk;
          $siswa->about = $request->about;
          $siswa->save();
          Session::flash('success', "Data Berhasil di Edit");
          return redirect('mastersiswa');

        }
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
        $siswa=Siswa::find($id)->delete();
        Session::flash('success', "Data Berhasil di Hapus");
        return redirect('/mastersiswa');
    }
}
