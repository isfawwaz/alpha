<?php

namespace Bam\Alpha\Bootstrap;

use Bam\Alpha\Contract\ConfigInterface;
use Bam\Alpha\Exception\FileNotFoundException;

class File {
    /**
     * Theme config instance.
     *
     * @var \Tonik\Gin\Foundation\ConfigInterface
     */
    protected $config;

    /**
     * Asset file.
     *
     * @var string
     */
    protected $file;

    /**
     * Construct asset.
     *
     * @param \Tonik\Gin\Foundation\ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }
    
    /**
     * Get asset file URI.
     *
     * @return string
     */
    public function getUri()
    {
        if ($this->fileExists($file = $this->getPublicPath())) {
            return $this->getPublicUri();
        }

        throw new FileNotFoundException("Asset file [$file] cannot be located.");
    }
    
    /**
     * Get asset file path.
     *
     * @return string
     */
    public function getPath()
    {
        if ($this->fileExists($file = $this->getPublicPath())) {
            return $file;
        }

        throw new FileNotFoundException("Asset file [$file] cannot be located.");
    }

    /**
     * Gets asset uri path.
     *
     * @return string
     */
    public function getPublicUri()
    {
        $uri = $this->config['paths']['uri'];

        return $uri . DIRECTORY_SEPARATOR . $this->getRelativePath();
    }

    /**
     * Gets asset directory path.
     *
     * @return string
     */
    public function getPublicPath()
    {
        $directory = $this->config['paths']['directory'];

        return $directory . DIRECTORY_SEPARATOR . $this->getRelativePath();
    }

    /**
     * Gets asset relative path.
     *
     * @return string
     */
    public function getRelativePath()
    {
        $public = $this->config['directories']['public'];

        return $public . DIRECTORY_SEPARATOR . $this->file;
    }

    /**
     * Checks if asset file exsist.
     *
     * @param  string $file
     *
     * @return boolean
     */
    public function fileExists($file)
    {
        return file_exists($file);
    }

    /**
     * Gets the Asset file.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Sets the Asset file.
     *
     * @param string $file the file
     *
     * @return self
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}