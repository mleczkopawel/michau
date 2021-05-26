<?php

namespace Application\Controller;

use Application\Entity\Area;
use Application\Entity\Fertilizer;
use Application\Entity\MeasureExperience;
use Application\Entity\Measurment;
use Application\Entity\Plant;
use Application\Entity\Surface;
use Application\Entity\SurfaceFertilizer;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * @var
     */
    private $em = null;

    /**
     * @param \Zend\Stdlib\RequestInterface $request
     * @param \Zend\Stdlib\ResponseInterface|null $response
     * @return mixed|\Zend\Stdlib\ResponseInterface
     */
    public function dispatch(RequestInterface $request, ResponseInterface $response = null)
    {
        $this->em = $this->getServiceLocator()->get('EntityManager');

        return parent::dispatch($request, $response);
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $area = $this->em->getRepository('Application\Entity\Area')->findAll();
        $fertilizer = $this->em->getRepository('Application\Entity\Fertilizer')->findAll();
        $measurment = $this->em->getRepository('Application\Entity\Measurment')->findAll();
        $plant = $this->em->getRepository('Application\Entity\Plant')->findAll();
        $surface = $this->em->getRepository('Application\Entity\Surface')->findAll();

        return new ViewModel(array(
            'areas' => $area,
            'fertilizers' => $fertilizer,
            'measurments' => $measurment,
            'plants' => $plant,
            'surfaces' => $surface,
        ));
    }

    /**
     *
     */
    public function saveAction() {
        $option = $this->params()->fromRoute('option');
        $data = $this->getRequest()->getPost();
        switch ($option) {
            case 'plants': {
                $plant = new Plant();
                $plant->setName($data['plantName']);
                $this->em->persist($plant);
                $this->em->flush();
                $response['code'] = 1;
            } break;
            case 'fertilizers': {
                $fertilizer = new Fertilizer();
                $fertilizer->setName($data['name']);
                $this->em->persist($fertilizer);
                $this->em->flush();
                $response['code'] = 1;
            }break;
            case 'surfaces': {
                $fertilizer = $this->em->getRepository('Application\Entity\Fertilizer')->find($data['fertilizer']);
                $surface = new Surface();
                $surface->setName($data['name']);
                $this->em->persist($surface);
                $this->em->flush();

                if ($fertilizer) {
                    $sf = new SurfaceFertilizer();
                    $sf->setFertilizerId($fertilizer);
                    $sf->setSurfaceId($surface);
                    $this->em->persist($sf);
                    $this->em->flush();
                }
                $response['code'] = 1;
            } break;
            case 'areas': {
                $plant = $this->em->getRepository('Application\Entity\Plant')->find($data['plant']);
                $surface = $this->em->getRepository('Application\Entity\Surface')->find($data['surface']);
                $area = new Area();
                $area->setName($data['name']);
                $area->setPlantId($plant);
                $area->setSurfaceId($surface);
                $area->setSize($data['size']);
                $this->em->persist($area);
                $this->em->flush();
                $response['code'] = 1;
            }break;
            case 'measure': {
                $area = $this->em->getRepository('Application\Entity\Area')->find($data['area']);
                $measure = new Measurment();
                $measure->setAddDate(new \DateTime(date('d.m.Y H:i:s')));
                $measure->setEndDate(new \DateTime($data['date']));
                $measure->setMeasureName($data['name']);
                $measure->setAreaId($area);
                $this->em->persist($measure);
                $this->em->flush();
                $response['code'] = 1;
            }break;
            case 'experience': {
                $measure = $this->em->getRepository('Application\Entity\Measurment')->find($data['measurment']);
                $me = new MeasureExperience();
                $me->setMeasureId($measure);
                $me->setDate(new \DateTime(date('d.m.Y H:i:s')));
                $me->setPlantCount($data['count']);
                $me->setPlantSize($data['size']);
                $this->em->persist($me);
                $this->em->flush();
                $response['code'] = 1;
            }break;
            default: {
                $response['code'] = 0;
            } break;
        }

        echo json_encode($response);die;
    }

    /**
     * @return ViewModel
     */
    public function plantsAction() {
        $plant = $this->em->getRepository('Application\Entity\Plant')->findAll();

        return new ViewModel(array(
            'plants' => $plant,
        ));
    }

    /**
     * @return ViewModel
     */
    public function fertilizersAction() {
        $fertilizer = $this->em->getRepository('Application\Entity\Fertilizer')->findAll();

        return new ViewModel(array(
            'fertilizers' => $fertilizer,
        ));
    }

    /**
     * @return ViewModel
     */
    public function surfacesAction() {
        $fertilizer = $this->em->getRepository('Application\Entity\Fertilizer')->findAll();
        $surface = $this->em->getRepository('Application\Entity\Surface')->getAllJoin();

        return new ViewModel(array(
            'surfaces' => $surface,
            'fertilizers' => $fertilizer,
        ));
    }

    /**
     * @return ViewModel
     */
    public function areasAction() {
        $area = $this->em->getRepository('Application\Entity\Area')->getAllJoin();
        $plant = $this->em->getRepository('Application\Entity\Plant')->findAll();
        $surface = $this->em->getRepository('Application\Entity\Surface')->findAll();

        return new ViewModel(array(
            'areas' => $area,
            'plants' => $plant,
            'surfaces' => $surface,
        ));
    }

    /**
     * @return ViewModel
     */
    public function measurmentsAction() {
        $measurments = $this->em->getRepository('Application\Entity\Measurment')->findAll();
        $areas = $this->em->getRepository('Application\Entity\Area')->findAll();

        $table = null;
        foreach ($measurments as $measurmentOne) {
            $measurment = $this->em->getRepository('Application\Entity\Measurment')->getAllJoin($measurmentOne->getId());
            $measurment = $measurment[0];
            $table .= "<tr><td>" . $measurment['mname'] . "</td><td>" . $measurment['aname'] ."</td><td>" . $measurment['sname'] ."</td><td>" . $measurment['pname'] ."</td><td>" . $measurment['fname'] ."</td><td>" . $measurment['size'] ."</td><td>" . $measurment['plant_count'] ."</td><td>" . $measurment['plant_size'] ."</td><td>" . $measurment['addDate']->format('d.m.Y H:i:s') ."</td><td>" . $measurment['min_date'] ."</td><td>" . $measurment['endDate']->format('d.m.Y H:i:s') ."</td><td>" . $measurment['max_date'] ."</td></tr>";
        }

        return new ViewModel(array(
            'measurments' => $table,
            'areas' => $areas,
            'measurmentsSelects' => $measurments,
        ));
    }
}
