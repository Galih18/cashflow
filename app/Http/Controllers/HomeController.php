<?php

namespace App\Http\Controllers;
use App\Kategori;
use App\Transaksi;
use App\User;
use Hash;
use Auth;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Nullable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tanggal_hari_ini = date('Y-m-d');
        $bulan_ini = date('m');
        $tahun_ini = date('Y');

        $pemasukan_hari_ini = Transaksi::where('jenis','pemasukan')
            ->whereDate('tanggal',$tanggal_hari_ini)
            ->sum('nominal');

        $pemasukan_bulan_ini = Transaksi::where('jenis','pemasukan')
            ->whereMonth('tanggal',$bulan_ini)
            ->sum('nominal');

        $pemasukan_tahun_ini = Transaksi::where('jenis','pemasukan')
            ->whereYear('tanggal',$tahun_ini)
            ->sum('nominal');

        $seluruh_pemasukan = Transaksi::where('jenis','pemasukan')->sum('nominal');
        
        $pengeluaran_hari_ini = Transaksi::where('jenis','pengeluaran')
            ->whereDate('tanggal',$tanggal_hari_ini)
            ->sum('nominal');

        $pengeluaran_bulan_ini = Transaksi::where('jenis','pengeluaran')
            ->whereMonth('tanggal',$bulan_ini)
            ->sum('nominal');

    
        $pengeluaran_tahun_ini = Transaksi::where('jenis','pengeluaran')
            ->whereMonth('tanggal',$tahun_ini)
            ->sum('nominal');
        
        $seluruh_pengeluaran = Transaksi::where('jenis','pengeluaran')->sum('nominal');

        return view('home',[
            'pemasukan_hari_ini'=>$pemasukan_hari_ini,
            'pemasukan_bulan_ini'=>$pemasukan_bulan_ini,
            'pemasukan_tahun_ini'=>$pemasukan_tahun_ini,
            'seluruh_pemasukan'=>$seluruh_pemasukan,
            'pengeluaran_hari_ini'=>$pengeluaran_hari_ini,
            'pengeluaran_bulan_ini'=>$pengeluaran_bulan_ini,
            'pengeluaran_tahun_ini'=>$pengeluaran_tahun_ini,
            'seluruh_pengeluaran'=>$seluruh_pengeluaran
        ]);
    }

    ///method show SEMUA KATEGORI
    public function kategori(){
        $kategori = Kategori::all();
        return view('kategori',['kategori'=>$kategori]);
    }


    //method untuk TAMBAH KATEGORI
    public function kategori_tambah(){
        return view('kategori_tambah');
    }


    //method untuk STORE TAMBAH
    public function kategori_aksi(Request $data){
        $data->validate([
            'kategori'=>'required'
        ]);

        $kategori = $data->kategori;

        Kategori::insert([
            'kategori'=>$kategori
        ]);

        return redirect('kategori')->with("sukses","Kategori Berhasil Tersimpan");
    }


    //Method untuk EDIT KATEGORI
    public function kategori_edit($id){
        $kategori = Kategori::find($id);
        return view('kategori_edit',['kategori'=>$kategori]);
    }



    //Method untuk UPDATE KATEGORI
    public function kategori_update( $id,Request $data ) {
        $data->validate ([
            'kategori'=>'required'
        ]);

        $nama_kategori = $data->kategori;

        //update kategori
        $kategori = Kategori::find($id);
        $kategori->kategori = $nama_kategori;
        $kategori->save();

        //alihkan halaman ke halaman kategori
        return redirect('kategori')->with("sukses","Kategori Berhasil di Ubah");
    }

        //Method untuk HAPUS KATEGORI
        public function kategori_hapus($id){
            $kategori = Kategori::find($id);
            $kategori->delete();

            //Menghapus transaksi berdasarkan id kategori yang dihapus
            $transaksi = Transaksi::where('kategori_id',$id);
            $kategori->delete();

            return redirect('kategori')->with("Sukses","Kategori Berhasil Dihapus");

        }

        // =============KUMPULAN SEMUA METHOD TRANSAKSI==============

        //Method untuk SHOW ALL TRANSAKSI
        public function transaksi(){
            // mengurutkan data transaksi berdasarkan id terbesar (transaksi terbaru)
            // dan menampilkannya dalam bentuk pagination

            $transaksi = Transaksi::orderBy('id','Desc')->paginate(7);

            //pasing data ke view transaksi.blade.php
            return view('transaksi',['transaksi'=>$transaksi]);
        }

        //Method untuk view TAMBAH TRANSAKSI

        public function transaksi_tambah(){
            // Mengambil data Kategori
            $kategori=Kategori::all();

            //Passing Data ke VIEW TRANSAKSI
            return view('transaksi_tambah',['kategori'=>$kategori]);
        }
        

        public function transaksi_aksi(Request $data){
            // Validasi tanggal, jenis,kategori, nominal wajib diisi
            $data->validate([
                'tanggal'=>'required',
                'jenis'=>'required',
                'kategori'=>'required',
                'nominal'=>'required'
            ]);
            //insert data ke tabel Transaksi
            Transaksi::insert([
                'tanggal'=>$data->tanggal,
                'jenis'=>$data->jenis,
                'kategori_id'=>$data->kategori,
                'nominal'=>$data->nominal,
                'keterangan'=>$data->keterangan
            ]);
//             alihkan halaman ke halaman transaksi sambil mengirim session pesan notifikasi

                return redirect('transaksi')->with("sukses","Transaksi Berhasil Tersimpan");
        }

        public function edit($id){
            //Mengambil data kategori
            $kategori=Kategori::all();

            //Mengambil data transaksi berdasarkan ID
            $transaksi = Transaksi::find($id);

            //Passing Data kategori dan transaksi ke view transksi_edit.blade.php
            return view('transaksi_edit',['kategori'=>$kategori,'transaksi'=>$transaksi]);

        }

        public function transaksi_update($id,Request $data){
            //validasi 
            $data->validate([
                'tanggal'=>'required',
                'jenis'=>'required',
                'kategori'=>'required',
                'nominal'=>'required'
            ]);
                // Ambil Transaksi Berdasarkan ID
            $transaksi=Transaksi::find($id);

            // Ubah data, tanggal, keterangan,jenis dll
            $transaksi->tanggal=$data->tanggal;
            $transaksi->jenis=$data->jenis;
            $transaksi->kategori_id=$data->kategori;
            $transaksi->nominal=$data->nominal;
            $transaksi->keterangan=$data->keterangan;

            //Simpan perubahan
            $transaksi->save();

            //Alihkan halaman ke halaman  TRANSAKSI sambil kirim pesan notifikasi
            return redirect('transaksi')->with("sukses","Transaksi Berhasil Diubah");
        }

        public function transaksi_hapus($id){
            $transaksi = Transaksi::find($id);
            $transaksi->delete();

            //Alihkan ke halaman transaksi dan notif berhasil
            return redirect('transaksi')->with("sukses","Transaksi Berhasil Dilakukan/Deleted");
        }

        public function cari(Request $data){
            //keyword Pencarian
            $cari = $data->cari;

            //Mengambil Data Transaksi
            $transaksi = Transaksi::orderBy('id','desc')
            ->where('jenis','like',"%".$cari."%")
            ->orWhere('tanggal','like',"%".$cari."%")
            ->orWhere('keterangan','like',"%".$cari."%")
            ->orWhere('nominal','=',"%".$cari."%")
            ->paginate(7);

            //Menambah keyword Pencarian ke data Transaksi
            $transaksi->appends($data->only('cari'));

            //Passing data Transaksi ke view transaksi.blade.php 
            return view('transaksi',['transaksi'=>$transaksi]);
        }

        public function laporan() {
            //data kategori
            $kategori = Kategori::all();

            //Passing data kategori ke view laporan
            return view('laporan',['kategori'=>$kategori]);
        }

        public function laporan_hasil(Request $request){
            $request->validate([
                'dari'=>'required',
                'sampai'=>'required'
            ]);

            //data kategori
            $kategori = Kategori::all();

            // data Filter
            $dari = $request->dari;
            $sampai = $request->sampai;
            $id_kategori = $request->kategori;

            //periksa kategori yg dipilih
            if($id_kategori == "semua") {
                //Jika semua tamilkan seluruh data transaksi
                $laporan = Transaksi::whereDate('tanggal','>=',$dari)
                                        ->whereDate('tanggal','<=',$sampai)
                                        ->orderBy('id','desc')->get();
            } else {
                //Jika yg dipilih bukan semua
                //tampilkan berdasarkan kategori yg dipilih
                $laporan = Transaksi::where('kategori_id',$id_kategori)
                                        ->whereDate('tanggal','>=',$dari)
                                        ->whereDate('tanggal','<=',$sampai)
                                        ->orderBy('id','desc')->get();
            }

            //passing laporan ke view laporan
            // return view('laporan_hasil',['laporan'=>$laporan,'kategori'=>$kategori]);
            return view('laporan_hasil')->with(compact('laporan'));
        }

        //Ganti Password
        public function ganti_password(){
            return view('gantipassword');
        }

        public function ganti_password_aksi(Request $request) {
            //Periksa Apakah  Password Sekarang (current password) sama dengan password sekarang
            if(!(Hash::check($request->get('current-password'), Auth::user()->password))){
                //Jika Tidak Sesuai alihkan kembali halaman ke form ganti password dan berikan notifikasi

                return redirect()->back()->with("error","Password Sekarang Tidak Sesuai.");
            }

            // periksa jika password baru sama dengan password yang sekarang
            if(strcmp($request->get('current-password'), $request->get('new-password'))== 0){
                // jika password baru yang diinput sama dengan password lama (password sekarang)
                // alihkan kembali ke form ganti password sambil mengirim pemberitahuan
                return redirect()->back()->with("error","Password baru tidak boleh sama dengan password sekarang.");
        }

        // membuat form validasi
        // password sekarang wajib diisi, password baru harus diisi,harus string, minimal 6 karakter,
        // dan harus sama dengan form konfirmasi password (connfirmation)
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
            ]);
        
            // Ganti password user/pengguna yang sedang login dengan password baru
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();

            // kembalikan halaman dan kirim pemberitahuan ganti password sukses
            return redirect()->back()->with("sukses","Password berhasil diganti!");

    }
}