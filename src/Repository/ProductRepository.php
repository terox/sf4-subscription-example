<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Terox\SubscriptionBundle\Repository\ProductRepositoryInterface;

class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findDefault()
    {
        $qb = $this->createQueryBuilder('product')
            ->select('product')
            ->where('product.default = :default')
            ->setParameter('default', true);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
