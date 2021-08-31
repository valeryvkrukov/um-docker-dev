<?php

namespace App\Behavior;

use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait as BaseTranslatableTrait;

trait TranslatableTrait
{
    use BaseTranslatableTrait;

    /**
     * @return string
     */
    public static function getTranslationEntityClass(): string
    {
        $explodedNamespace = explode('\\', __CLASS__);
        $entityClass = array_pop($explodedNamespace);

        return '\\' . implode('\\', $explodedNamespace) . '\\Translation\\' . $entityClass . 'Translation';
    }
}