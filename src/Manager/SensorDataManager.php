<?php

namespace App\Manager;


use App\Entity\SensorData;
use App\Repository\SensorDataRepository;

/**
 * Class SensorDataManager
 * @package App\Manager
 *
 * @method SensorData create()
 * @method SensorDataRepository getRepository()
 */
class SensorDataManager extends AbstractBaseManager
{

    public function getClass()
    {
        return SensorData::class;
    }

}
