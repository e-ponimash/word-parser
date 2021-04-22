<?php


namespace App\Services;

use App\Models\Word;

class StoreService implements StoreInterface
{
    public function store($words){
        $words = collect($words);
        $words->each(function($item){
            $word = Word::where(['word'=>$item->word, 'level'=>$item->level]);
            if($word->count()){
                $word = $word->first();
                ++$word->count;
                $word->save();
            } else {
                $item->save();
            }
        });
        return count($words);
    }
}
