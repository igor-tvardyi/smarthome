<?php

namespace App\Controller;


use App\Entity\Sensor;
use App\Form\SensorDataType;
use App\Manager\SensorDataManager;
use FOS\RestBundle\Controller\Annotations as Rest;
use oliverlorenz\reactphpmqtt\ClientFactory;
use oliverlorenz\reactphpmqtt\MqttClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SensorDataController extends AbstractBaseController
{

    protected $sensorDataManager;

    public function __construct(SensorDataManager $sensorDataManager)
    {
        $this->sensorDataManager = $sensorDataManager;
    }

    /**
     * @Rest\Post("/api/sensors-data/{sensor}", requirements={"sensor": "\d+"})
     *
     * @param Request $request
     * @param Sensor $sensor
     * @return Response
     */
    public function post(Request $request, Sensor $sensor)
    {
        $sensorData = $this->sensorDataManager->create();
        $sensorData->setSensor($sensor);

        $form = $this->createForm(SensorDataType::class, $sensorData);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $this->getResponse($form, 400);
        }

        $this->sensorDataManager->update($sensorData);

        return $this->getResponse($sensorData);
    }



    /**
     * @Rest\Post("/api/mqtt-data/{sensor}", requirements={"sensor": "\d+"})
     *
     * @param Request $request
     * @param Sensor $sensor
     * @return Response
     */
    public function post2(Request $request, Sensor $sensor)
    {
        $connector = ClientFactory::createClient(new Version4());

        $p = $connector->connect($config['server'], $config['port'], $config['options']);
        $p->then(function(\React\Stream\Stream $stream) use ($connector) {
            $stream->on(Publish::EVENT, function(Publish $message) {
                print_r($message);
            });

            $connector->subscribe($stream, 'a/b', 0);
            $connector->subscribe($stream, 'a/c', 0);
        });

        $connector->getLoop()->run();

        die;

        $sensorData = $this->sensorDataManager->create();
        $sensorData->setSensor($sensor);

        $form = $this->createForm(SensorDataType::class, $sensorData);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $this->getResponse($form, 400);
        }

        $this->sensorDataManager->update($sensorData);

        return $this->getResponse($sensorData);
    }

}
