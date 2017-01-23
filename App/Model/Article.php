<?php

class Article
{
    protected $header;
    protected $preview;
    protected $article;

    public function __construct($header, $preview, $article)
    {
        $this->header = $header;
        $this->preview = $preview;
        $this->article = $article;
    }

    public function returnHeader()
    {
        return $this->header;
    }

    public function returnPreview()
    {
        return $this->preview;
    }

    public function returnArticle()
    {
        return $this->article;
    }
}