<?php

namespace App\Http\Controllers;

use App\Quote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        $quote          = new Quote();
        $quote->content = $request->input('content');
        $quote->save();

        return response()->json(
            [
                'quote' => $quote,
                'user'=>\auth()->user()
            ],
            201
        );
    }

    public function index()
    {
        $quotes   = Quote::all();
        $response = [
            'quote' => $quotes,
        ];

        return response()->json($response, 200);
    }

    public function update(Request $request, int $id)
    {
        $quote = Quote::find($id);
        if ( !$quote ) {
            return response()->json(
                [
                    'message' => 'Document not found',
                ],
                404
            );
        }
        $quote->content = $request->input('content');
        $quote->save();

        return response()->json(
            [
                'quote' => $quote,
                'user'  => \auth()->user(),
            ],
            200
        );
    }

    public function delete(int $id)
    {
        $quote = Quote::find($id);
        $quote->delete();

        return response()->json(
            [
                'message' => 'Quote Deleted',
            ],
            200
        );

    }
}
