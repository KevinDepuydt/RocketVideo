<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 01/06/2016
 * Time: 13:03
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class StreamRepository extends EntityRepository
{
    const STREAM_NOT_DOWNLOAD = 1;
    const STREAM_PROCESS_DOWNLOAD = 2;
    const STREAM_DOWNLOADED = 3;
    
    public function findOneByState($state)
    {
        $q = $this
            ->createQueryBuilder('s')
            ->select('s')
            ->where('s.state = :state')
            ->setParameter('state', $state)
            ->getQuery();
        
        $stream = $q->getSingleResult();

        return $stream;
    }

    public function findByPublic($public)
    {
        $q = $this
            ->createQueryBuilder('s')
            ->select('s')
            ->where('s.public = :public')
            ->setParameter('public', $public)
            ->getQuery();

        $streams = $q->getArrayResult();

        return $streams;
    }

    public function findByName($name)
    {
        $q = $this
            ->createQueryBuilder('s')
            ->select('s')
            ->where('s.name = :name')
            ->setParameter('name', $name)
            ->getQuery();
        
        return $q->getSingleResult();
    }
}