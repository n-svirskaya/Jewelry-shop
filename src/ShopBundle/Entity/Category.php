<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 * @UniqueEntity(
 *     fields={"transName"},
 *     message="This name is already used in this shop."
 * )
 * @ORM\Table(name="js_categories")
 * @ORM\Entity(repositoryClass="ShopBundle\Entity\CategoryRepository")
 */
class Category
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
     * @var string
     * @Assert\NotBlank(message="Name missing!")
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * @ORM\OneToMany(targetEntity="Good", mappedBy="category")
     **/
    private $goods;

    /**
     * @var string
     *
     * @ORM\Column(name="transName", type="string", length=255)
     */
    private $transName;

    /**
     * Constructor
     */
        public function __construct()
    {
        $this->goods = new \Doctrine\Common\Collections\ArrayCollection();

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
     * @return Category
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
     * @return Category
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
     * Set picture
     *
     * @param string $picture
     * @return Category
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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setTransName($TransName)
    {
        $this->transName = $TransName;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getTransName()
    {
        return $this->name;
    }

    /**
     * Add goods
     *
     * @param \ShopBundle\Entity\Good $goods
     * @return Category
     */
    public function addGood(\ShopBundle\Entity\Good $goods)
    {
        $this->goods[] = $goods;

        return $this;
    }

    /**
     * Remove goods
     *
     * @param \ShopBundle\Entity\Good $goods
     */
    public function removeGood(\ShopBundle\Entity\Good $goods)
    {
        $this->goods->removeElement($goods);
    }

    /**
     * Get goods
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGoods()
    {
        return $this->goods;
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
        return 'uploads/categories';
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
