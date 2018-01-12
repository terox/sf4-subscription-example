<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Terox\SubscriptionBundle\Model\ProductInterface;
use Terox\SubscriptionBundle\Repository\SubscriptionRepositoryInterface;

class SubscriptionRepository extends EntityRepository implements SubscriptionRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getNumberOfSubscriptionsByProducts(ProductInterface $product)
    {
        $qb = $this->createQueryBuilder('subscription')
            ->select('COUNT(subscription.id)')
            ->where('subscription.product = :product')
            ->setParameter('product', $product);

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findByProduct(ProductInterface $product, $enabled = true)
    {
        $qb = $this->createQueryBuilder('subscription')
            ->where('subscription.product = :product')
            ->andWhere('subscription.active = :active')
            ->setParameter('product', $product)
            ->setParameter('active', $enabled);

        return $qb->getQuery()->getResult();
    }
}
