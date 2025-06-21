<?php
/**
 * Image Resize Class
 * Supports JPG, JPEG, PNG, GIF, and WebP formats
 * Requires PHP GD library
 * 
 * Usage:
 * $resizer = new ImageResize('path/to/image.jpg');
 * $resizer->resize(800, 600, 'cover'); // or 'contain', 'exact', 'auto'
 * $resizer->save('path/to/resized_image.jpg', 90); // Quality 0-100
 */
class ImageResize {
    private $image;
    private $width;
    private $height;
    private $imageResized;
    private $originalInfo = [];
    private $quality = 85;

    /**
     * Constructor - Loads the image file
     * @param string $filename Path to image file
     * @throws Exception If file doesn't exist, isn't readable, or isn't a valid image
     */
    public function __construct($filename) {
        if (!file_exists($filename)) {
            throw new Exception('Image file does not exist: ' . $filename);
        }

        if (!is_readable($filename)) {
            throw new Exception('Image file is not readable: ' . $filename);
        }

        $this->originalInfo = [
            'width' => 0,
            'height' => 0,
            'mime' => '',
            'format' => ''
        ];

        $imageInfo = @getimagesize($filename);
        if (!$imageInfo) {
            throw new Exception('File is not a valid image: ' . $filename);
        }

        $this->originalInfo = [
            'width' => $imageInfo[0],
            'height' => $imageInfo[1],
            'mime' => $imageInfo['mime'],
            'format' => preg_replace('/^image\//', '', $imageInfo['mime'])
        ];

        $this->image = $this->openImage($filename);
        if ($this->image === false) {
            throw new Exception('Unable to open image: ' . $filename);
        }

        $this->width = $imageInfo[0];
        $this->height = $imageInfo[1];
    }

    /**
     * Open an image file and return GD resource
     * @param string $file Path to image file
     * @return resource|false GD image resource or false on failure
     */
    private function openImage($file) {
        switch ($this->originalInfo['format']) {
            case 'jpeg':
            case 'jpg':
                return @imagecreatefromjpeg($file);
            case 'gif':
                return @imagecreatefromgif($file);
            case 'png':
                return @imagecreatefrompng($file);
            case 'webp':
                if (function_exists('imagecreatefromwebp')) {
                    return @imagecreatefromwebp($file);
                }
                throw new Exception('WebP format not supported by this server');
            default:
                throw new Exception('Unsupported image format: ' . $this->originalInfo['format']);
        }
    }

    /**
     * Resize the image
     * @param int $newWidth Target width
     * @param int $newHeight Target height
     * @param string $mode Resize mode: 'cover', 'contain', 'exact', 'auto'
     * @return void
     */
    public function resize($newWidth, $newHeight, $mode = 'cover') {
        $options = $this->calcDimensions($newWidth, $newHeight, $mode);
        
        $this->imageResized = imagecreatetruecolor($options['width'], $options['height']);
        
        // Preserve transparency for PNG and GIF
        if ($this->originalInfo['format'] == 'gif' || $this->originalInfo['format'] == 'png') {
            imagecolortransparent($this->imageResized, imagecolorallocatealpha($this->imageResized, 0, 0, 0, 127));
            imagealphablending($this->imageResized, false);
            imagesavealpha($this->imageResized, true);
        }

        imagecopyresampled(
            $this->imageResized, $this->image,
            $options['x'], $options['y'],
            $options['src_x'], $options['src_y'],
            $options['width'], $options['height'],
            $options['src_w'], $options['src_h']
        );

        // Free up memory from original image
        imagedestroy($this->image);
    }

    /**
     * Calculate dimensions for resizing
     * @param int $newWidth Target width
     * @param int $newHeight Target height
     * @param string $mode Resize mode
     * @return array Dimensions and positions
     */
    private function calcDimensions($newWidth, $newHeight, $mode) {
        $src_x = 0;
        $src_y = 0;
        $src_w = $this->width;
        $src_h = $this->height;

        $width = $newWidth;
        $height = $newHeight;
        $x = 0;
        $y = 0;

        switch ($mode) {
            case 'exact':
                // Exact dimensions - may distort
                break;

            case 'cover':
                // Cover - crop to fill exactly
                $ratio = max($newWidth / $this->width, $newHeight / $this->height);
                $src_w = round($newWidth / $ratio);
                $src_h = round($newHeight / $ratio);
                $src_x = ($this->width - $src_w) / 2;
                $src_y = ($this->height - $src_h) / 2;
                break;

            case 'contain':
                // Contain - fit inside dimensions
                $ratio = min($newWidth / $this->width, $newHeight / $this->height);
                $width = round($this->width * $ratio);
                $height = round($this->height * $ratio);
                $x = ($newWidth - $width) / 2;
                $y = ($newHeight - $height) / 2;
                break;

            case 'auto':
            default:
                // Auto - same as contain but don't add padding
                $ratio = min($newWidth / $this->width, $newHeight / $this->height);
                $width = round($this->width * $ratio);
                $height = round($this->height * $ratio);
                break;
        }

        return [
            'x' => $x, 'y' => $y,
            'width' => $width, 'height' => $height,
            'src_x' => $src_x, 'src_y' => $src_y,
            'src_w' => $src_w, 'src_h' => $src_h
        ];
    }

    /**
     * Save the resized image
     * @param string $savePath Path to save the image
     * @param int|null $quality Image quality (0-100)
     * @return bool True on success
     * @throws Exception If save fails
     */
    public function save($savePath, $quality = null) {
        if (!$this->imageResized) {
            throw new Exception('No resized image to save');
        }

        $quality = $quality ?? $this->quality;
        $extension = strtolower(pathinfo($savePath, PATHINFO_EXTENSION));

        // Create directory if it doesn't exist
        $dir = dirname($savePath);
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0755, true)) {
                throw new Exception('Failed to create directory: ' . $dir);
            }
        }

        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $success = imagejpeg($this->imageResized, $savePath, $quality);
                break;
            case 'gif':
                $success = imagegif($this->imageResized, $savePath);
                break;
            case 'png':
                // Convert quality from 0-100 to 0-9
                $quality = 9 - round(($quality / 100) * 9);
                $success = imagepng($this->imageResized, $savePath, $quality);
                break;
            case 'webp':
                if (!function_exists('imagewebp')) {
                    throw new Exception('WebP format not supported by this server');
                }
                $success = imagewebp($this->imageResized, $savePath, $quality);
                break;
            default:
                throw new Exception('Unsupported image format for saving: ' . $extension);
        }

        if (!$success) {
            throw new Exception('Failed to save image: ' . $savePath);
        }

        imagedestroy($this->imageResized);
        return true;
    }

    /**
     * Set default image quality
     * @param int $quality Quality (0-100)
     */
    public function setQuality($quality) {
        $this->quality = max(0, min(100, $quality));
    }

    /**
     * Get original image info
     * @return array Original image information
     */
    public function getOriginalInfo() {
        return $this->originalInfo;
    }

    /**
     * Destructor - Clean up resources
     */
    public function __destruct() {
        if (is_resource($this->image)) {
            imagedestroy($this->image);
        }
        if (is_resource($this->imageResized)) {
            imagedestroy($this->imageResized);
        }
    }
}