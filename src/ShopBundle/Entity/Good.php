<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Good
 *
 * @ORM\Table(name="js_goods")
 * @ORM\Entity(repositoryClass="ShopBundle\Entity\GoodRepository")
 */
class Good
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Category missing!")
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="goods")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var string
     * @Assert\Length(
     *     min=3,
     *     max=50,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     * )
     * @Assert\NotBlank
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message="Price missing!")
     * @ORM\Column(name="price", type="string", length=255)
     */
    private $price;

    /**
     * @var string
     * @Assert\File(
     *     maxSize = "10M",
     *     mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif",
     *          "application/pdf",
     *          "application/x-pdf"
     *      },
     *     mimeTypesMessage = "Please upload a valid PDF/JPEG/JPG/GIF"
     * )
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;

    /**
     * @var boolean
     *
     * @ORM\Column(name="featured", type="boolean", nullable=true)
     */
    private $featured;

    /**
     * @var boolean
     *
     * @ORM\Column(name="new", type="boolean", nullable=true)
     */
    private $new;

    /**
     * @var boolean
     *
     * @ORM\Column(name="promotion", type="boolean", nullable=true)
     */
    private $promotion;

    /**
     * @return boolean
     */
    public function isFeatured()
    {
        return $this->featured;
    }

    /**
     * @param boolean $featured
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }

    /**
     * @return boolean
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * @param boolean $new
     */
    public function setNew($new)
    {
        $this->new = $new;
    }

    /**
     * @return boolean
     */
    public function isPromotion()
    {
        return $this->promotion;
    }

    /**
     * @param boolean $promotion
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
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
     * Set name
     *
     * @param string $name
     * @return Good
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Good
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Good
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Good
     */
    public function setPicture(UploadedFile $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set category
     *
     * @param \ShopBundle\Entity\Category $category
     * @return Good
     */
    public function setCategory(\ShopBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \ShopBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function getAbsolutePath()
    {
        return null === $this->picture
            ? null
            : $this->getUploadRootDir() . '/' . $this->picture;
    }

    public function getWebPath()
    {
        return null === $this->picture
            ? null
            : $this->getUploadDir() . '/' . $this->picture;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    public function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/goods';
    }
    /**
     * @ORM\PrePersist()
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getPicture()) {
            return;
        }
        /** @var UploadedFile $fPicture */
        $fPicture = $this->getPicture();
        $dirPath = $this->getUploadRootDir();
        $picture = $fPicture->getClientOriginalName();
        $ext = $fPicture->guessExtension();
        $name = substr($picture, 0, - strlen($ext));
        $i = 1;

        while(file_exists($dirPath . '/' .  $picture)) {
            $picture = $name . '-' . $i .'.'. $ext;
            $i++;
        }

        $fPicture->move($dirPath, $picture);
        $this->picture = $picture;
    }


    public function displaySymbols($srting, $num1, $num2)
    {
        $str = substr($srting, $num1, $num2);

        return $str;
    }

    public function countSymbols($srting)
    {
        return iconv_strlen($srting);
    }
}
