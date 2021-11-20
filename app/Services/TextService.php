<?php

namespace App\Services;

class TextService
{
    public const END_OF_WORDS_KEYS = [
        "\'",
        "\"",
        "^",
        "?",
        "!",
        ":",
        "(",
        "#",
        "№",
        ")",
        " ",
        ",",
        "—",
        "-",
        ".",
        ";",
        '<br/>',
        '<br>',
        "\r\n",
        "\t",
        "\n"
    ];

    private $text = '';
    private $nonUniqueWords = [];
    private $uniqueWords = [];

    public function __construct(string $text)
    {
        $this->text = mb_strtolower($text);
    }

    public function loadNonUniqueWordsAsArray(): array
    {
        $unidelim = self::END_OF_WORDS_KEYS[0];

        $step_01 = str_replace(self::END_OF_WORDS_KEYS, $unidelim, $this->text);

        $exploded = explode($unidelim, $step_01);

        $this->nonUniqueWords = array_filter($exploded, fn ($w) => !empty($w));

        return $this->nonUniqueWords;
    }

    public function loadUniqueWordsAsArray(): array
    {
        if (empty($this->nonUniqueWords)) {
            $this->loadNonUniqueWordsAsArray();
        }

        if (empty($this->nonUniqueWords)) {
            return [];
        }

        $words = array_values($this->nonUniqueWords);

        $this->uniqueWords = [];

        for ($i = 0, $len = count($words); $i < $len; $i++) {
            $this->uniqueWords[mb_strtolower($words[$i])] = 0;
        }

        return $this->uniqueWords;
    }

    public function loadCountFoundWordsInTextAsArray(): array
    {
        if (empty($this->nonUniqueWords)) {
            $this->loadNonUniqueWordsAsArray();
        }

        if (empty($this->nonUniqueWords)) {
            return [];
        }

        return array_count_values($this->nonUniqueWords);
    }
}
