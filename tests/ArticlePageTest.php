<?php

class ArticlePageTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_to_see_article_page()
    {
        $this->visit('/articles')
             ->see('Published Articles');
    }
}
