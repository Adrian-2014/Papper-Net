<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class bookSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookPath = database_path('seeders/dbSeed/books.csv');

        $file = fopen($bookPath, 'r');

        if (!File::exists($bookPath)) {
            $this->command->error("File not found: {$bookPath}");
            return;
        }


        // Skip header
        fgetcsv($file);

        while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
            DB::table('books')->insert([
                'id' => $data[0],
                'nama' => $data[1],
                'penulis' => $data[2],
                'type' => $data[3],
                'harga' => $data[4],
                'kualitas' => $data[5],
                'gambar' => $data[6],
                'created_at' => $data[7],
                'updated_at' => $data[8],
            ]);
        }

        fclose($file);

    }
}
