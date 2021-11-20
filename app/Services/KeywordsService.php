<?php

namespace App\Services;

use App\Services\TextService;

class KeywordsService
{
    private $keywords = [];
    private $isUsedCalculated = false;
    private $textService;

    public function __construct(array $keywords, TextService $textService)
    {
        $this->keywords = $keywords;
        $this->textService = $textService;
    }

    public function calculateUsedKeywords(): array
    {
        $countFoundWords = $this->textService->loadCountFoundWordsInTextAsArray();

        for ($i = 0, $len = count($this->keywords); $i < $len; $i++) {
            $this->keywords[$i]['applied'] = $countFoundWords[mb_strtolower($this->keywords[$i]['name'])] ?? 0;
        }

        $this->isUsedCalculated = true;

        return $this->keywords;
    }

    public function loadUnusedKeywordsByProjectAsString(): string
    {
        if (!$this->isUsedCalculated) {
            $this->calculateUsedKeywords();
        }

        $result = [];

        for ($i = 0, $len = count($this->keywords); $i < $len; $i++) {
            if ($this->keywords[$i]['needed'] > $this->keywords[$i]['applied']) {
                $result[] = $this->keywords[$i]['name'];
            }
        }

        return implode('; ', $result);
        // HashSet<string> matches = GetWordsToHighlight();

        // foreach (string matchWord in matches)
        // {
        //     MatchCollection allIp = Regex.Matches(originalText, matchWord, RegexOptions.IgnoreCase);

        //     for (int i = 0, findCnt = allIp.Count; i < findCnt; i++)
        //     {
        //         tempRichText.Select(allIp[i].Index, allIp[i].Length);
        //         tempRichText.SelectionBackColor = Color.Yellow;
        //     }

        //     allIp = null;
        // }
    }

    // private string[] GetWords(string text)
    // {
    //     if (text.Length == 0)
    //     {
    //         return new string[0];
    //     }

    //     text = text
    //         .Replace("?", "^")
    //         .Replace("!", "^")
    //         .Replace(":", "^")
    //         .Replace("(", "^")
    //         .Replace("#", "^")
    //         .Replace("№", "^")
    //         .Replace(")", "^")
    //         .Replace(" ", "^")
    //         .Replace(",", "^")
    //         .Replace(" - ", "^")
    //         .Replace("—", "^")
    //         .Replace("–", "^")
    //         .Replace("-", "^")
    //         .Replace(".", "^")
    //         .Replace(";", "^")
    //         .Replace("\t", "^")
    //         .Replace("\n", "^")
    //         .Replace("\r\n", "^")
    //         .ToLower();

    //     return text.Split(new Char[] { '^' }, StringSplitOptions.RemoveEmptyEntries);
    // }
}
