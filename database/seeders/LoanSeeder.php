<?php

namespace Database\Seeders;

Use App\Models\Loan;
Use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book = Book::first();

        if($book != null && $book->available_copies > 0) {
            Loan::create([
                'book_id' => $book->id,
                'borrower_name' => 'John Doe',
            ]);

           
            $book->decrement('available_copies');
        } else {
            $this->command->info('Nincs elérhető könyv a kölcsönzéshez. Kérem, futtassa előbb a BookSeeder-t.');
        }


       
    }
}
