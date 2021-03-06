<?php

namespace Pfe\Bundle\PageBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageRepository extends EntityRepository
{
    public function findAllByLocale($locale)
    {
        $query = $this->getEntityManager()->createQueryBuilder('p');
        $query->select('p, pTrans')
            ->from('PfePageBundle:Page', 'p')
            ->innerJoin('p.translations', 'pTrans')
            ->where('pTrans.locale = :locale')
            ->setParameter('locale', $locale);

        return $query->getQuery()->getResult();
    }

    public function findOneByLocale($token = null, $locale)
    {
        $query = $this->getEntityManager()->createQueryBuilder('p');
        $query->select('p, pTrans')
            ->from('PfePageBundle:Page', 'p')
            ->innerJoin('p.translations', 'pTrans')
            ->where('p.token = :token')
            ->andWhere('pTrans.locale = :locale')
            ->setParameters(array('locale' => $locale, 'token' => $token));

        return $query->getQuery()->getOneOrNullResult();
    }

    public function findOneByLocaleAndSlug($locale, $slug)
    {
        $query = $this->getEntityManager()->createQueryBuilder('p');
        $query->select('p, pTrans')
            ->from('PfePageBundle:Page', 'p')
            ->innerJoin('p.translations', 'pTrans')
            ->where('pTrans.slug = :slug')
            ->andWhere('pTrans.locale = :locale')
            ->setParameters(array('locale' => $locale, 'slug' => $slug));

        return $query->getQuery()->getOneOrNullResult();
    }

    public function findHome($locale)
    {
        $query = $this->getEntityManager()->createQueryBuilder('p');
        $query->select('p, pTrans')
            ->from('PfePageBundle:Page', 'p')
            ->innerJoin('p.translations', 'pTrans')
            ->where('p.template = :template')
            ->andWhere('pTrans.locale = :locale')
            ->setParameters(array('locale' => $locale, 'template' => 1));

        return $query->getQuery()->getOneOrNullResult();
    }
}
