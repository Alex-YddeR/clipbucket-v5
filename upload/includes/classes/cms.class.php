<?php

class CMS
{
    private static $CMS;
    private $content;
    private $params;

    public function __construct(string $content, array $params = []){
        $this->content = $content;
        $this->params = $params;
    }

    public static function getInstance(string $content, array $params = []): CMS
    {
        $key = md5($content);
        if( empty(self::$CMS[$key]) ){
            self::$CMS[$key] = new self($content, $params);
        }
        return self::$CMS[$key];
    }

    private function generateLinks(): void
    {
        if (preg_match_all("#(^|\s|\()((http(s?)://)|(www\.))(\w+[^\s\)\<]+)#i", $this->content, $matches)) {
            for ($i = 0; $i < count($matches['0']); $i++) {
                $period = '';
                if (preg_match("|\.$|", $matches['6'][$i])) {
                    $period = '.';
                    $matches['6'][$i] = substr($matches['6'][$i], 0, -1);
                }
                $this->content = str_replace($matches['0'][$i],
                    $matches['1'][$i] . '<a href="http' .
                    $matches['4'][$i] . '://' .
                    $matches['5'][$i] .
                    $matches['6'][$i] . '">http' .
                    $matches['4'][$i] . '://' .
                    $matches['5'][$i] .
                    $matches['6'][$i] . '</a>' .
                    $period, $this->content);
            }
        }
    }

    private function generateCensored(): void
    {
        $censored_words = explode(',',config('censored_words'));
        foreach ($censored_words as $word) {
            $word = trim($word);
            $this->content = str_ireplace($word, str_repeat('*', strlen($word)), $this->content);
        }
    }

    private function clean(): void
    {
        $this->content = display_clean($this->content);
    }

    public function getClean(): string
    {
        $this->clean();

        if( !empty($this->params['links']) ){
            $this->generateLinks();
        }

        if( !empty($this->params['censor']) ){
            $this->generateCensored();
        }

        if( !empty($this->params['functionList']) ){
            $func_list = ClipBucket::getInstance()->getFunctionList($this->params['functionList']);
            if (is_array($func_list) && count($func_list) > 0) {
                foreach ($func_list as $func) {
                    $this->content = $func($this->content);
                }
            }
        }

        return nl2br($this->content);
    }

}