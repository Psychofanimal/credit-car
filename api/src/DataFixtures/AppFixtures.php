<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\CalcStartegy;
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

        $calcStrategy = new CalcStartegy();
        $calcStrategy->setTitle('ВТБ "Лайт"');
        $calcStrategy->setInterestRate(15.5);
        $calcStrategy->setMonthlyPayment(20000);
        $calcStrategy->setProgramId(101);
        $manager->persist($calcStrategy);

        $calcStrategy = new CalcStartegy();
        $calcStrategy->setTitle('Сбер "Кабала"');
        $calcStrategy->setInterestRate(45.5);
        $calcStrategy->setMonthlyPayment(120000);
        $calcStrategy->setProgramId(666);
        $manager->persist($calcStrategy);

        $calcStrategy = new CalcStartegy();
        $calcStrategy->setTitle('Alfa Energy');
        $calcStrategy->setInterestRate(12.3);
        $calcStrategy->setMonthlyPayment(9800);
        $calcStrategy->setProgramId(203);
        $manager->persist($calcStrategy);

        $manager->flush();
    }
}
