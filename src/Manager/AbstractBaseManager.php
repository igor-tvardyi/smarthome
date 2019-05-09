<?php

namespace App\Manager;


use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractBaseManager
{
    protected $class;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * AbstractBaseManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return string
     */
    abstract public function getClass();

    /**
     * @return mixed
     */
    public function create()
    {
        $class = $this->getClass();

        return new $class();
    }

    /**
     * @param $entity
     * @param bool $andFlush
     */
    public function update($entity, $andFlush = true)
    {
        $this->em->persist($entity);

        if ($andFlush) {
            $this->em->flush();
        }
    }

    /**
     * @param $entity
     * @param bool $andFlush
     */
    public function remove($entity, $andFlush = true)
    {
        $this->em->remove($entity);

        if ($andFlush) {
            $this->em->flush();
        }
    }

    /**
     * @return ObjectRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository($this->getClass());
    }

}
