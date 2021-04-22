<?php


namespace App\Services;


class TokenizerService implements TokenizerInterface
{
    private $delimiters = ['?', '.', '!', ' ', ',', "\r","\n"];
    private $brackets = ['{', '[', '(', '}', ']', ')'];

    public function execute($body): array
    {
        $words = array();
        $word = '';
        for ($i = 0; $i < strlen($body); $i++){
            $char = $body[$i];
            if ($this->isDelimiter($char) || $this->isBracket($char)){
                if($word != '')
                    array_push($words, $word);
                $word = '';
                if ($this->isBracket($char))
                    array_push($words, $char);
            } else
                $word .= $char;
        }
        if($word != '')
            array_push($words, $word);
        return $words;
    }

    private function isDelimiter($char): bool
    {
        return in_array($char, $this->delimiters);
    }

    private function isBracket($char): bool
    {
        return in_array($char, $this->brackets);
    }
}
