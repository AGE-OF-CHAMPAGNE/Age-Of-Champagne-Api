<?php

namespace App\Factory;

use App\Entity\Recipient;
use App\Repository\RecipientRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Recipient>
 *
 * @method        Recipient|Proxy                     create(array|callable $attributes = [])
 * @method static Recipient|Proxy                     createOne(array $attributes = [])
 * @method static Recipient|Proxy                     find(object|array|mixed $criteria)
 * @method static Recipient|Proxy                     findOrCreate(array $attributes)
 * @method static Recipient|Proxy                     first(string $sortedField = 'id')
 * @method static Recipient|Proxy                     last(string $sortedField = 'id')
 * @method static Recipient|Proxy                     random(array $attributes = [])
 * @method static Recipient|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RecipientRepository|RepositoryProxy repository()
 * @method static Recipient[]|Proxy[]                 all()
 * @method static Recipient[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Recipient[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Recipient[]|Proxy[]                 findBy(array $attributes)
 * @method static Recipient[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Recipient[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class RecipientFactory extends ModelFactory
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
            'address' => self::faker()->streetAddress(),
            'city' => self::faker()->city(),
            'name' => self::faker()->company(),
            'phoneNumber' => self::faker()->phoneNumber(),
            'postalCode' => self::faker()->postcode(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Recipient $recipient): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Recipient::class;
    }
}
