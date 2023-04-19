<?php

namespace App\Factory;

use App\Entity\DidYouKnow;
use App\Repository\DidYouKnowRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<DidYouKnow>
 *
 * @method        DidYouKnow|Proxy create(array|callable $attributes = [])
 * @method static DidYouKnow|Proxy createOne(array $attributes = [])
 * @method static DidYouKnow|Proxy find(object|array|mixed $criteria)
 * @method static DidYouKnow|Proxy findOrCreate(array $attributes)
 * @method static DidYouKnow|Proxy first(string $sortedField = 'id')
 * @method static DidYouKnow|Proxy last(string $sortedField = 'id')
 * @method static DidYouKnow|Proxy random(array $attributes = [])
 * @method static DidYouKnow|Proxy randomOrCreate(array $attributes = [])
 * @method static DidYouKnowRepository|RepositoryProxy repository()
 * @method static DidYouKnow[]|Proxy[] all()
 * @method static DidYouKnow[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static DidYouKnow[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static DidYouKnow[]|Proxy[] findBy(array $attributes)
 * @method static DidYouKnow[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static DidYouKnow[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class DidYouKnowFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'description' => self::faker()->text(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(DidYouKnow $didYouKnow): void {})
        ;
    }

    protected static function getClass(): string
    {
        return DidYouKnow::class;
    }
}
