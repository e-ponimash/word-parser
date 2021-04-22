<?php

namespace App\Http\Controllers;

use App\Services\ParserInterface;
use App\Services\StoreInterface;
use App\Services\TokenizerInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class WordController extends BaseController
{
    public function store(Request $request, TokenizerInterface $tokenizer, ParserInterface $parser, StoreInterface $store){
        $body = $request->input('body');
        $tokens = $tokenizer->execute($body);
        $words = $parser->execute($tokens);
        $store->store($words);

        return response()->json([
            'success' => true,
            'words' => $words
        ]);
    }
}
