<?php

namespace Framework;

use Framework\Database;

class FileStorage
{

    protected $fileRawData = [];
    protected $fileData = [];
    protected $postData = [];
    protected $db;
    protected $typeOfAsset;
    protected $fileName;
    protected $fileExtension;
    protected $brand;
    protected $brandName;
    protected $imageArrayKey;

    public function __construct()
    {
        $this->fileData = $_FILES;
        $this->postData = $_POST;
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Extract image key for DB
     * 
     * @param array $fileData
     * @return string $fileKey
     */
    public function getImgKey()
    {
        foreach ($this->fileData as $key => $value) {
            $this->imageArrayKey = $key;
        }
        $this->fileRawData = $value;
        return $this->imageArrayKey;
    }


    /**
     * Validate a string
     * 
     * @param array $postData
     * @param array $fileData
     * @return string $imageUrl
     */
    public function returnImgUrl()
    {

        /**
         * brand_logo_url: storage/brand-name/brand_assets/image.png/jpg
         * 
         * product_image_url: storage/brand-name/product-name/image.png/jpg
         * 
         * post_media_url: 
         * 
         */

        $imgKey = $this->getImgKey();

        if (str_contains($_SERVER['HTTP_REFERER'], 'brands')) {
            $this->typeOfAsset = 'brand_assets';
            $this->brandName = $this->postData['brand_name'];
        } else if (str_contains($_SERVER['HTTP_REFERER'], 'product')) {
            $params = ['id' => $this->postData['brand_id']];
            $this->typeOfAsset = 'products/' . slugify($this->postData['name']);
            $this->brand = $this->db->query('SELECT * FROM brands WHERE id = :id', $params)->fetch();
            $this->brandName = $this->brand->brand_name;
        } else if (str_contains($_SERVER['HTTP_REFERER'], 'new-user')) {
            $this->typeOfAsset = slugify($this->postData['name']);
            $this->brandName = 'users';
        }

        $nameArr = explode(".", $this->fileRawData['name']);
        $this->fileName = slugify($nameArr[0]);
        $this->fileExtension = $nameArr[1];

        $imageUrl = $_SERVER['HTTP_ORIGIN'] . '/storage/' . slugify($this->brandName) . '/' . $this->typeOfAsset . '/' . $this->fileName . '.' . $this->fileExtension;

        return $imageUrl;
    }

    /**
     * Handle the upload, create folders
     * 
     * @param array $postData
     * @return void
     */
    public function uploadImage()
    {
        // Define the base path for storage
        $basePath = $_SERVER['DOCUMENT_ROOT'] . "/storage/";

        // Construct the directory path and the full file path
        $directoryPath = $basePath . slugify($this->brandName) . '/' . $this->typeOfAsset . '/';
        $filePath = $directoryPath . $this->fileName . '.' . $this->fileExtension;

        // Check if the directory exists, and if not, create it
        if (!is_dir($directoryPath)) {
            if (!mkdir($directoryPath, 0777, true)) {
                die("Failed to create directories.");
            }
        }

        // Move the uploaded file to the final destination
        if (!move_uploaded_file($this->fileData[$this->imageArrayKey]['tmp_name'], $filePath)) {
            die("Failed to upload image.");
        }
    }

    /**
     * File delete
     * 
     * @param string $imgUrl
     * @return void
     */
    public function deleteImage($imgUrl)
    {
        // Convert the URL to a server file path
        $filePath = $_SERVER['DOCUMENT_ROOT'] . parse_url($imgUrl, PHP_URL_PATH);

        // Check if the file exists
        if (file_exists($filePath)) {
            // Try to delete the file
            if (unlink($filePath)) {
                echo "File deleted successfully.";

                // Get the directory path
                $directoryPath = dirname($filePath);

                // Check if the directory is empty
                if ($this->isDirectoryEmpty($directoryPath)) {
                    // Try to delete the directory
                    if (rmdir($directoryPath)) {
                        echo " Directory deleted successfully.";
                    } else {
                        echo " Failed to delete directory.";
                    }
                }
            } else {
                echo "Failed to delete file.";
            }
        } else {
            echo "File does not exist.";
        }
    }

    private function isDirectoryEmpty($dir)
    {
        // Check if the directory is empty
        if (!is_readable($dir)) return false;
        return (count(scandir($dir)) == 2);
    }
}
