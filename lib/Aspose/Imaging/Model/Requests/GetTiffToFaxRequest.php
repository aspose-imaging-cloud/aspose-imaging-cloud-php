<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="GetTiffToFaxRequest.php">
 *   Copyright (c) 2019 Aspose Pty Ltd. All rights reserved.
 * </copyright>
 * <summary>
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 * 
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 * 
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 * </summary>
 * --------------------------------------------------------------------------------------------------------------------
 */

namespace Aspose\Imaging\Model\Requests;

use \InvalidArgumentException;
use Aspose\Imaging\Configuration;

/**
 * Request model for getTiffToFax operation.
 */
class GetTiffToFaxRequest extends ImagingRequest
{
    /**
     * Filename of image.
     */
    public $name;
    
    /**
     * Your Aspose Cloud Storage name.
     */
    public $storage;
    
    /**
     * Folder with image to process.
     */
    public $folder;
    
    /**
     * Path to updated file (if this is empty, response contains streamed image).
     */
    public $out_path;
    
    /**
     * Initializes a new instance of the GetTiffToFaxRequest class.
     *  
     * @param string $name Filename of image.
     * @param string $storage Your Aspose Cloud Storage name.
     * @param string $folder Folder with image to process.
     * @param string $out_path Path to updated file (if this is empty, response contains streamed image).
     */
    public function __construct($name, $storage = null, $folder = null, $out_path = null)             
    {
        parent::__construct();
        $this->name = $name;
        $this->storage = $storage;
        $this->folder = $folder;
        $this->out_path = $out_path;
    }

    /**
     * Filename of image.
     */
    public function get_name()
    {
        return $this->name;
    }

    /**
     * Filename of image.
     *
     * @return 
     */
    public function set_name($value)
    {
        $this->name = $value;
        return $this;
    }
    
    /**
     * Your Aspose Cloud Storage name.
     */
    public function get_storage()
    {
        return $this->storage;
    }

    /**
     * Your Aspose Cloud Storage name.
     *
     * @return 
     */
    public function set_storage($value)
    {
        $this->storage = $value;
        return $this;
    }
    
    /**
     * Folder with image to process.
     */
    public function get_folder()
    {
        return $this->folder;
    }

    /**
     * Folder with image to process.
     *
     * @return 
     */
    public function set_folder($value)
    {
        $this->folder = $value;
        return $this;
    }
    
    /**
     * Path to updated file (if this is empty, response contains streamed image).
     */
    public function get_out_path()
    {
        return $this->out_path;
    }

    /**
     * Path to updated file (if this is empty, response contains streamed image).
     *
     * @return 
     */
    public function set_out_path($value)
    {
        $this->out_path = $value;
        return $this;
    }

    /**
     * Prepares initial info for HTTP request
     *
     * @param Configuration $config Imaging API configuration.
     */
    public function getHttpRequestInfo(Configuration $config)
    {
        // verify the required parameter 'name' is set
        if ($this->name === null) {
            throw new \InvalidArgumentException('Missing the required parameter $name when calling getTiffToFax');
        }

        $resourcePath = '/imaging/tiff/{name}/toFax';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $multipart = false;
    
        // path params
        if ($this->name !== null) {
            $localName = lcfirst('name');
            $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($this->name), $resourcePath);
        }

        // query params
        if ($this->storage !== null) {
            $localName = lcfirst('storage');
            $localValue = is_bool($this->storage) ? ($this->storage ? 'true' : 'false') : $this->storage;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->folder !== null) {
            $localName = lcfirst('folder');
            $localValue = is_bool($this->folder) ? ($this->folder ? 'true' : 'false') : $this->folder;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
        // query params
        if ($this->out_path !== null) {
            $localName = lcfirst('outPath');
            $localValue = is_bool($this->out_path) ? ($this->out_path ? 'true' : 'false') : $this->out_path;
            if (strpos($resourcePath, '{' . $localName . '}') !== false) {
                $resourcePath = str_replace('{' . $localName . '}', ObjectSerializer::toPathValue($localValue), $resourcePath);
            } else {
                $queryParams[$localName] = ObjectSerializer::toQueryValue($localValue);
            }
        }
    
    
        $resourcePath = $this->parseURL($resourcePath, $queryParams, $config);

        // body params
        $httpBody = null;

        if ($multipart) {
            $headers= $this->headerSelector->selectHeadersForMultipart(
                ['multipart/form-data']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['multipart/form-data'],
                ['application/json']
            );
        }
        
        list($httpInfo) = [$resourcePath, $formParams, $queryParams, $headerParams, $httpBody, $multipart];
        return $httpInfo;        
    }
}
