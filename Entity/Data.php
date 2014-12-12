<?php
/**
 * This file is part of JKN
 *
 * (c) Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 *
 * @author : Muhamad Surya Iksanudin
 **/
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serialize;
use Ihsan\MalesBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DataRepository")
 * @ORM\Table(name="data")
 *
 * @Serialize\ExclusionPolicy("all")
 **/
class Data extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serialize\Expose
     **/
    protected $id;

    /**
     * @ORM\Column(name="code_indikator", type="string", length=4)
     **/
    protected $indikator;

    /**
     * @ORM\Column(name="nominator", type="decimal", scale=0, precision=12)
     **/
    protected $nominator;

    /**
     * @ORM\Column(name="de_nominator", type="decimal", scale=0, precision=12)
     **/
    protected $deNominator;

    /**
     * @ORM\Column(name="value", type="decimal", scale=0, precision=12)
     **/
    protected $value;

    /**
     * @ORM\Column(name="bulan", type="smallint")
     **/
    protected $bulan;

    /**
     * @ORM\Column(name="tahun", type="integer")
     **/
    protected $tahun;

    /**
     * @ORM\Column(name="kelurahan", type="string", length=7)
     **/
    protected $kelurahan;

    /**
     * @ORM\Column(name="kecamatan", type="string", length=6)
     **/
    protected $kecamatan;

    /**
     * @ORM\Column(name="kabupaten", type="string", length=4)
     **/
    protected $kabupaten;

    /**
     * @ORM\Column(name="propinsi", type="string", length=2)
     **/
    protected $propinsi;

    public function getName()
    {
        return;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set indikator
     *
     * @param string $indikator
     * @return Data
     */
    public function setIndikator($indikator)
    {
        $this->indikator = $indikator;

        return $this;
    }

    /**
     * Get indikator
     *
     * @return string 
     */
    public function getIndikator()
    {
        return $this->indikator;
    }

    /**
     * Set nominator
     *
     * @param string $nominator
     * @return Data
     */
    public function setNominator($nominator)
    {
        $this->nominator = $nominator;

        return $this;
    }

    /**
     * Get nominator
     *
     * @return string 
     */
    public function getNominator()
    {
        return $this->nominator;
    }

    /**
     * Set deNominator
     *
     * @param string $deNominator
     * @return Data
     */
    public function setDeNominator($deNominator)
    {
        $this->deNominator = $deNominator;

        return $this;
    }

    /**
     * Get deNominator
     *
     * @return string 
     */
    public function getDeNominator()
    {
        return $this->deNominator;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Data
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set bulan
     *
     * @param integer $bulan
     * @return Data
     */
    public function setBulan($bulan)
    {
        $this->bulan = $bulan;

        return $this;
    }

    /**
     * Get bulan
     *
     * @return integer 
     */
    public function getBulan()
    {
        return $this->bulan;
    }

    /**
     * Set tahun
     *
     * @param integer $tahun
     * @return Data
     */
    public function setTahun($tahun)
    {
        $this->tahun = $tahun;

        return $this;
    }

    /**
     * Get tahun
     *
     * @return integer 
     */
    public function getTahun()
    {
        return $this->tahun;
    }

    /**
     * Set kelurahan
     *
     * @param string $kelurahan
     * @return Data
     */
    public function setKelurahan($kelurahan)
    {
        $this->kelurahan = $kelurahan;

        return $this;
    }

    /**
     * Get kelurahan
     *
     * @return string 
     */
    public function getKelurahan()
    {
        return $this->kelurahan;
    }

    /**
     * Set kecamatan
     *
     * @param string $kecamatan
     * @return Data
     */
    public function setKecamatan($kecamatan)
    {
        $this->kecamatan = $kecamatan;

        return $this;
    }

    /**
     * Get kecamatan
     *
     * @return string 
     */
    public function getKecamatan()
    {
        return $this->kecamatan;
    }

    /**
     * Set kabupaten
     *
     * @param string $kabupaten
     * @return Data
     */
    public function setKabupaten($kabupaten)
    {
        $this->kabupaten = $kabupaten;

        return $this;
    }

    /**
     * Get kabupaten
     *
     * @return string 
     */
    public function getKabupaten()
    {
        return $this->kabupaten;
    }

    /**
     * Set propinsi
     *
     * @param string $propinsi
     * @return Data
     */
    public function setPropinsi($propinsi)
    {
        $this->propinsi = $propinsi;

        return $this;
    }

    /**
     * Get propinsi
     *
     * @return string 
     */
    public function getPropinsi()
    {
        return $this->propinsi;
    }
}
