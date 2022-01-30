<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Program;
use App\Entity\ProgramType;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class ProgramTest extends ApiTestCase
{
    use ReloadDatabaseTrait;

    /**
     * Test creating Programs with overlaping rooms
     */
    public function testCreateProgramRoomOverlap()
    {
        $client = self::createClient();

        //create a ProgramType entity
        $programType = new ProgramType();
        $programType->setName('PILATES');
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $em->persist($programType);
        $em->flush();
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $em->persist($programType);
        $em->flush();

        //create a Room entity
        $room = new Room();
        $room->setName('CAMERA A');
        $room->setMaxPersonsInRoom(20);
        $room->addProgramType($programType);
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $em->persist($room);
        $em->flush();

        //create a Program entity
        $program = new Program();
        $program->setName('PILATES INCEPATORI 1');
        //programs are in future +10 Days
        $start     = new \DateTimeImmutable();
        $twoweeks = new \DateInterval('P10D');
        $start = $start->add($twoweeks);
        //each program takes 1 hour
        $period = new \DateInterval('PT1H');
        $end = $start->add($period);
        $program->setStartDateTime($start);
        $program->setEndDateTime($end);
        $program->setRoom($room);
        $program->setNumarMaximParticipanti(20);
        $program->setParticipants(10);
        $program->setProgramType($programType);
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $em->persist($program);
        $em->flush();

        //create second Room entity
        $room2 = new Room();
        $room2->setName('CAMERA B');
        $room2->setMaxPersonsInRoom(20);
        $room2->addProgramType($programType);
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $em->persist($room2);
        $em->flush();

        //create a Program entity
        $program2 = new Program();
        $program2->setName('PILATES AVANSATI');
        //programs are in future +10 Days
        $start     = new \DateTimeImmutable();
        $twoweeksand20min = new \DateInterval('P10DT20M');
        $start = $start->add($twoweeksand20min);
        //each program takes 1 hour
        $period = new \DateInterval('PT1H');
        $end = $start->add($period);
        $program2->setStartDateTime($start);
        $program2->setEndDateTime($end);
        $program2->setRoom($room);
        $program2->setNumarMaximParticipanti(20);
        $program2->setParticipants(10);
        $program2->setProgramType($programType);
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $em->persist($program2);
        $em->flush();

        //am definit cnp ca fiind string....
        $client->request('POST', '/api/bookings', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'cnp' => '1660713034972',
                'program' => '/api/programs/' . $program->getId(),
            ],
        ]);
        $this->assertResponseStatusCodeSame(201);

        //am definit cnp ca fiind string....
        $client->request('POST', '/api/bookings', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'cnp' => '1660713034972',
                'program' => '/api/programs/' . $program2->getId(),
            ],
        ]);
        $this->assertResponseStatusCodeSame(201);

    }
}