<?php

namespace App\Entity;

use Terox\SubscriptionBundle\Model\ProductInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table(name="Products")
 */
class Product implements ProductInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ProductInterface
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(name="next_renewal_product_id", referencedColumnName="id", nullable=true)
     */
    private $nextRenewalProduct;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(type="float", length=255, nullable=false)
     */
    private $amount;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, options={"unsigned":true})
     *
     * Duration in seconds.
     */
    private $duration;

    /**
     * @var integer|null
     *
     * @ORM\Column(type="integer", nullable=true, options={"unsigned":true})
     */
    private $quota;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $autoRenewal;

    /**
     * @var boolean
     * 
     * @ORM\Column(type="boolean", name="is_default", nullable=false)
     */
    private $default;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expirationDate;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $strategyCodeName;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->setDefault(false);
        $this->setExpirationDate(null);
        $this->setAutoRenewal(false);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNextRenewalProduct()
    {
        return $this->nextRenewalProduct;
    }

    /**
     * @param mixed $nextRenewalProduct
     *
     * @return Product
     */
    public function setNextRenewalProduct($nextRenewalProduct)
    {
        $this->nextRenewalProduct = $nextRenewalProduct;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return Product
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param integer $duration
     *
     * @return Product
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuota()
    {
        return $this->quota;
    }

    /**
     * @param int|null $quota
     *
     * @return Product
     */
    public function setQuota($quota)
    {
        $this->quota = $quota;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAutoRenewal()
    {
        return $this->autoRenewal;
    }

    /**
     * @param bool $autoRenewal
     *
     * @return Product
     */
    public function setAutoRenewal($autoRenewal)
    {
        $this->autoRenewal = $autoRenewal;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * @param bool $default
     *
     * @return Product
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param \DateTime $expirationDate
     *
     * @return Product
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getStrategyCodeName()
    {
        return $this->strategyCodeName;
    }

    /**
     * @param string $strategyCodeName
     *
     * @return Product
     */
    public function setStrategyCodeName($strategyCodeName)
    {
        $this->strategyCodeName = $strategyCodeName;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return Product
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName() ?: 'No name';
    }
}
