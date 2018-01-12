<?php

namespace App\DataFixtures\ORM;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProductData extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $product1 = new Product();
        $product1
            ->setName('Product 1 - That expires in 10 days')
            ->setAmount(5)
            ->setDuration(3600*24*10)
            ->setStrategyCodeName('end_last')
            ->setAutoRenewal(false)
            ->setEnabled(true);

        $manager->persist($product1);

        $product2 = new Product();
        $product2
            ->setName('Product 2 - That expires in 30 days and auto-renewals')
            ->setAmount(20)
            ->setDuration(3600*24*30)
            ->setStrategyCodeName('end_last')
            ->setAutoRenewal(true)
            ->setEnabled(true);

        $manager->persist($product2);

        $productPermanent = new Product();
        $productPermanent
            ->setName('Product Permananet: not expires')
            ->setAmount(100)
            ->setDuration(null)
            ->setStrategyCodeName('end_last')
            ->setAutoRenewal(false)
            ->setEnabled(true);

        $manager->persist($productPermanent);

        $manager->flush();
    }
}