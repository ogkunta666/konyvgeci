<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    
    public function index()
    {
       return response()->json(Loan::all(), 200);
    }

   
    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'book_id' => 'required|exists:books,id',
                'borrower_name' => 'required|string|max:255',
            ]);
            $book = \App\Models\Book::find($validatedData['book_id']);
            
            if ($book->available_copies < 1) {
                return response()->json(['message' => 'Nincs elérhető példány a könyvből.'], 400);
            } 

            $loan = Loan::create($validatedData);
            $book->decrement('available_copies');

            return response()->json($loan, 201);
    }

    
    public function show(Loan $loan)
    {
        
    }

  
    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);    
        if ($loan->returned_at) {
            return response()->json(['message' => 'A könyv már vissza lett adva.'], 400);
        }
        $loan->update(['returned_at' => now()]);
        $loan->book->increment('available_copies');
        return response()->json($loan, 200);
    }

   
    public function destroy(Loan $loan)
    {
        
    }
}
