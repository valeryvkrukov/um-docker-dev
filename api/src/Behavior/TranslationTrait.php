<?php

namespace App\Behavior;

use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait as BaseTranslationTrait;

trait TranslationTrait
{
    use BaseTranslationTrait;

    /**
     * @return string
     */
    public static function getTranslatableEntityClass(): string
    {
        $explodedNamespace = explode('\\', __CLASS__);
        $entityClass = array_pop($explodedNamespace);
        array_pop($explodedNamespace);

        return '\\' . implode('\\', $explodedNamespace) . '\\' . substr($entityClass, 0, -11);
    }
}