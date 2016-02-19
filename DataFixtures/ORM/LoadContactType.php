<?php
// src/WH/UserBundle/DataFixtures/ORM/LoadContactType.php

namespace WH\OrganisationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use APP\OrganisationBundle\Entity\ContactType;

class LoadContactType implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $list = array(
            'Email',
            'Téléphone fixe',
            'Mobile',
            'Skype',
            'Blog / Site web',
            'Fax',
            'FaceBook',
            'Viadeo'
        );

        foreach ($list as $v) {
            // On crée l'utilisateur
            $c = new ContactType;

            // Le nom d'utilisateur et le mot de passe sont identiques
            $c->setName($v);

            // On le persiste
            $manager->persist($c);
        }

        // On déclenche l'enregistrement
        $manager->flush();
    }
}