<?php

namespace Pionyr\PionyrCz\Entity;

class ArticlePreview extends AbstractArticle
{
    public static function createFromResponseData(\stdClass $responseData)
    {
        $object = new static();
        static::setCommonArticleResponseDataToObject($responseData, $object);

        return $object;
    }

    /**
     * @param array $responseDataArray
     * @return ArticlePreview[]
     */
    public static function createFromResponseDataArray(array $responseDataArray)
    {
        $entities = [];
        foreach ($responseDataArray as $responseData) {
            $entities[] = self::createFromResponseData($responseData);
        }

        return $entities;
    }
}
