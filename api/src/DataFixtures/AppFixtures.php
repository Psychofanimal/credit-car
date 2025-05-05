<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brand = new Brand();
        $brand->setName('Opel');
        $manager->persist($brand);

        $model = new Model();
        $model->setName('Astra');
        $manager->persist($model);

        $property = new Property();
        $property->setBrand($brand);
        $property->setModel($model);
        $property->setPhoto('');
        $property->setPrice('1450999');
        $manager->persist($property);

        $model = new Model();
        $model->setName('Corsa');
        $manager->persist($model);

        $property = new Property();
        $property->setBrand($brand);
        $property->setModel($model);
        $property->setPhoto('');
        $property->setPrice('735000');
        $manager->persist($property);

        $brand = new Brand();
        $brand->setName('Mazda');
        $manager->persist($brand);
        $manager->persist($brand);

        $model = new Model();
        $model->setName('MX-5');
        $manager->persist($model);

        $property = new Property();
        $property->setBrand($brand);
        $property->setModel($model);
        $property->setPhoto('');
        $property->setPrice('5735900');
        $manager->persist($property);

        $manager->flush();
    }
}
