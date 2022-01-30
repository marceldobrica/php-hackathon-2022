<?php

namespace App\DataFixtures;

use App\Entity\Bookings;
use App\Entity\Program;
use App\Entity\ProgramType;
use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //create 3 ProgramType
        {
            $programType1 = new ProgramType();
            $programType1->setName('PILATES');
            $manager->persist($programType1);

            $programType2 = new ProgramType();
            $programType2->setName('DANCE');
            $manager->persist($programType2);

            $programType3 = new ProgramType();
            $programType3->setName('GIM');
            $manager->persist($programType3);
        }

        //create 3 rooms
        {
            $room1 = new Room();
            $room1->setName('ROOM A')
                ->setMaxPersonsInRoom(20)
                ->addProgramType($programType1);
            $manager->persist($room1);

            $room2 = new Room();
            $room2->setName('ROOM B')
                ->setMaxPersonsInRoom(30)
                ->addProgramType($programType1)
                ->addProgramType($programType2);
            $manager->persist($room2);

            $room3 = new Room();
            $room3->setName('ROOM C')
                ->setMaxPersonsInRoom(10)
                ->addProgramType($programType3);
            $manager->persist($room3);
        }

        //create 3 programs
        {
            $program1 = new Program();
            $program1->setName('PILATES INCEPATORI')
                ->setProgramType($programType1)
                ->setRoom($room1)
                ->setNumarMaximParticipanti(10)
                ->setParticipants(1);
            $start = new \DateTimeImmutable();
            $program1->setStartDateTime($start->add(new \DateInterval('P10D')))
                ->setEndDateTime($start->add(new \DateInterval('P10DT1H')));
            $manager->persist($program1);

            $program2 = new Program();
            $program2->setName('PILATES INCEPATORI')
                ->setProgramType($programType1)
                ->setRoom($room1)
                ->setNumarMaximParticipanti(10)
                ->setParticipants(1);
            $start = new \DateTimeImmutable();
            $program2->setStartDateTime($start->add(new \DateInterval('P11D')))
                ->setEndDateTime($start->add(new \DateInterval('P11DT1H')));
            $manager->persist($program2);

            $program3 = new Program();
            $program3->setName('PILATES INCEPATORI')
                ->setProgramType($programType1)
                ->setRoom($room2)
                ->setNumarMaximParticipanti(10)
                ->setParticipants(1);
            $start = new \DateTimeImmutable();
            $program3->setStartDateTime($start->add(new \DateInterval('P12D')))
                ->setEndDateTime($start->add(new \DateInterval('P12DT1H')));
            $manager->persist($program3);
        }

        //create 2 bookings
        {
            $booking1 = new Bookings();
            $booking1->setCnp('1660713034972')->setProgram($program1);
            $manager->persist($booking1);

            $booking2 = new Bookings();
            $booking2->setCnp('1660713034972')->setProgram($program2);
            $manager->persist($booking2);
        }

        $manager->flush();
    }
}
