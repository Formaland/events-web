<?php

namespace Pfe\Bundle\EventBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    public function findAllByLocale($locale)
    {
        $query = $this->getEntityManager()->createQueryBuilder('p');
        $query->select('p, pTrans')
            ->from('PfeEventBundle:Category', 'p')
            ->innerJoin('p.translations', 'pTrans')
            ->where('pTrans.locale = :locale')
            ->setParameter('locale', $locale);

        return $query->getQuery()->getResult();
    }

    public function findOneByLocale($token = null, $locale)
    {
        $query = $this->getEntityManager()->createQueryBuilder('p');
        $query->select('p, pTrans')
            ->from('PfeEventBundle:Category', 'p')
            ->innerJoin('p.translations', 'pTrans')
            ->where('p.token = :token')
            ->andWhere('pTrans.locale = :locale')
            ->setParameters(array('locale' => $locale, 'token' => $token));

        return $query->getQuery()->getOneOrNullResult();
    }
}