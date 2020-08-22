<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Pengaturan Bahasa Faker
        $faker = Faker::create('id_ID');

        //input data dummy
        for($x=1; $x<=20; $x++ ){
            //data dummy
            $tgl_hari_ini = date('Y-m-d');
            $jenis = $faker->randomElement(["Pemasukan","Pengeluaran"]);
            $kategori = $faker->randomElement(["1","2","3","4","12"]);
            $nominal = $faker->randomElement(["1000","2000","3000","5000","7600","9000","13000","23000"]);
            $keterangan="";

            // insert ke DATABASE
            DB::table('transaksi')->insert([
                'tanggal'=>$tgl_hari_ini,
                'jenis'=>$jenis,
                'kategori_id'=>$kategori,
                'nominal'=>$nominal,
                'keterangan'=>$keterangan
            ]);
        }
    }
}
