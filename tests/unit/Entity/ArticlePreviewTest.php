<?php

namespace Pionyr\PionyrCz\Entity;

use PHPUnit\Framework\TestCase;
use Pionyr\PionyrCz\Constants\ArticleCategory;
use Ramsey\Uuid\Uuid;

/**
 * @covers \Pionyr\PionyrCz\Entity\AbstractArticle
 * @covers \Pionyr\PionyrCz\Entity\ArticlePreview
 * @covers \Pionyr\PionyrCz\Entity\IdentifiableTrait
 */
class ArticlePreviewTest extends TestCase
{
    /** @test */
    public function shouldCreateArticleFromResponseJson()
    {
        $responseData = json_decode(file_get_contents(__DIR__ . '/Fixtures/article-preview.json'));
        $article = ArticlePreview::createFromResponseData($responseData);
        $this->assertSame('Aktualita', $article->getTitle());
        $this->assertEquals(Uuid::fromString('635124ec-3d05-447d-acc4-2a87d7a711a3'), $article->getUuid());
        $this->assertSame('635124ec-3d05-447d-acc4-2a87d7a711a3', $article->getUuid()->toString());
        $this->assertSame('5dQgVtfyTfje6wXfRyjEgK', $article->getShortUuid());
        $this->assertEquals(new \DateTimeImmutable('2018-04-27 13:33:36'), $article->getDatePublished());
        $this->assertSame('Akce a soutěže', $article->getCategory());
        $this->assertSame(ArticleCategory::AKCE_A_SOUTEZE, $article->getCategoryId());
        $this->assertSame('John Doe', $article->getAuthorName());
        $this->assertSame('<p>Perex</p>', $article->getPerex());
        $this->assertSame('http://photo.url/goo.jpg', $article->getPerexPhotoUrl());
    }

    /** @test */
    public function shouldCreateMultipleEntitiesFromResponseJson()
    {
        $responseData = json_decode(file_get_contents(__DIR__ . '/Fixtures/article-preview-list.json'));
        $articles = ArticlePreview::createFromResponseDataArray((array) $responseData);
        $this->assertCount(2, $articles);
        $this->assertContainsOnlyInstancesOf(ArticlePreview::class, $articles);
    }
}
