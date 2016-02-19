<?php
// src/WH/UserBundle/DataFixtures/ORM/LoadLegalForm.php

namespace WH\OrganisationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use APP\OrganisationBundle\Entity\LegalForm;

class LoadLegalForm implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Liste des noms de compétences à ajouter
        $legalForms = array(
            array(
                'name' => 'Particulier'
            ),
            array(
                'name' => 'Profession liberale'
            ),
            array(
                'name' => 'Eurl'
            ),
            array(
                'name' => 'Sarl'
            ),
            array(
                'name' => 'Sasu'
            ),
            array(
                'name' => 'Sas'
            ),
            array(
                'name' => 'Sa'
            )
        );

        foreach($legalForms as $a) {

            //1 : On définit l'instence de l'objet
            $l = new LegalForm;

            $l->setName($a['name']);

            $manager->persist($l);


        }

        $manager->flush();

    }
}