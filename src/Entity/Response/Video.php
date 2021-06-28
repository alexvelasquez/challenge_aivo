<?php

namespace App\Entity\Response;

class Video
{
    private $publishedAt;
    private $id;
    private $title;
    private $description;
    private $thumbnail;
    private $extra;

    public function __construct(array $response)
    {
        $this->publishedAt = $response['snippet']['publishedAt'];
        $this->id = $response['id'];
        $this->title = $response['snippet']['title'];
        $this->description = $response['snippet']['description'];
        $this->thumbnail = $response['snippet']['thumbnails']['default']['url'];
        $this->extra = $response['statistics'];
    }

    /**
     * Get the value of publishedAt
     */ 
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set the value of publishedAt
     *
     * @return  self
     */ 
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of extra
     */ 
    public function getExtra() : Array
    {
        return $this->extra;
    }

    /**
     * Set the value of extra
     *
     * @return  self
     */ 
    public function setExtra($extra)
    {
        $this->extra = $extra;

        return $this;
    }
}
