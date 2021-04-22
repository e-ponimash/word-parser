<?php
namespace App\Services;


use App\Exceptions\BadFormatException;
use App\Models\Word;

class ParserService implements ParserInterface
{
    private $bracketsOpen = ['{', '[', '('];
    private $bracketsClosed = ['}', ']', ')'];

    public function execute($tokens): array
    {
        $level = 0;
        $words = array();
        $brackets = array();
        $counts = [0];

        foreach ($tokens as $token){
            if (in_array($token, $this->bracketsOpen)){
                ++$level;
                array_push($brackets, $token);
                array_push( $counts, 0);
                continue;
            }

            if ( ($index = array_search($token, $this->bracketsClosed)) !== false){
                $prev_bracket = array_pop($brackets);
                if (is_null($prev_bracket))
                    throw new BadFormatException('Непарные скобки');

                if ($index === array_search($prev_bracket, $this->bracketsOpen)){
                    if( $counts[array_key_last($counts)] < 3)
                        throw new BadFormatException('Количество слов на уровне меньше 3');
                    --$level;
                    array_pop($counts);
                    continue;
                }
                throw new BadFormatException('Непарные скобки');
            }

            $token = new Word(['word' => $token, 'level' => $level, 'count' => 1]);
            array_push($words, $token);
            $counts[array_key_last($counts)]++;
        }

        if( count($brackets) > 0 )
            throw new BadFormatException('Непарные скобки');
        if( $counts[array_key_last($counts)] < 3 && $counts[array_key_last($counts)] > 0)
            throw new BadFormatException('Количество слов на уровне меньше 3');

        return $words;
    }
}
