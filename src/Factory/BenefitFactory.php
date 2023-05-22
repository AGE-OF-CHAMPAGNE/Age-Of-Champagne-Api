<?php

namespace App\Factory;

use App\Entity\Benefit;
use App\Repository\BenefitRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Benefit>
 *
 * @method        Benefit|Proxy                     create(array|callable $attributes = [])
 * @method static Benefit|Proxy                     createOne(array $attributes = [])
 * @method static Benefit|Proxy                     find(object|array|mixed $criteria)
 * @method static Benefit|Proxy                     findOrCreate(array $attributes)
 * @method static Benefit|Proxy                     first(string $sortedField = 'id')
 * @method static Benefit|Proxy                     last(string $sortedField = 'id')
 * @method static Benefit|Proxy                     random(array $attributes = [])
 * @method static Benefit|Proxy                     randomOrCreate(array $attributes = [])
 * @method static BenefitRepository|RepositoryProxy repository()
 * @method static Benefit[]|Proxy[]                 all()
 * @method static Benefit[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Benefit[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Benefit[]|Proxy[]                 findBy(array $attributes)
 * @method static Benefit[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Benefit[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class BenefitFactory extends ModelFactory
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
            'title' => self::faker()->text(10),
            'recipient' => RecipientFactory::random(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Benefit $benefit): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Benefit::class;
    }
}
