<?php
// src/WH/OrganisationBundle/DataFixtures/ORM/LoadMarketingSource.php

namespace WH\OrganisationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use APP\OrganisationBundle\Entity\CustomerState;

class LoadCostumerState implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $list = array(
            0       => 'Prospect',
            100     => 'Client',
            150     => 'Client à renouveller',
            500     => 'Client perdu',
            600     => 'Ancien client',
            1000    => 'Partenaire',
            1100    => 'Fournisseur',
            1200    => 'Exterrieur',
            1300    => 'Apporteur d’affaire',
            9999    => 'Interne',
        );

        foreach ($list as $k => $v) {
            // On crée l'utilisateur
            $c = new CustomerState;

            // Le nom d'utilisateur et le mot de passe sont identiques
            $c->setName($v);
            $c->setLevel($k);

            // On le persiste
            $manager->persist($c);
        }

        // On déclenche l'enregistrement
        $manager->flush();
    }
}