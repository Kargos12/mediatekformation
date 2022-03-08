<?php
namespace App\tests;

use App\Entity\Formation;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Description of DateParutionTest
 * Test unitaire sur le fonctionnement de la méthode qui retourne la date de parution au format string
 * @author Kargos
 */
class DateParutionTest extends TestCase {
    
    public function testgetPublishedAtString(){
        $formation = new Formation();
        $formation->setPublishedAt (new DateTime("2022-03-08"));
        $this->assertEquals("08/03/2022", $formation->getPublishedAtString());
    }
    
    
}
