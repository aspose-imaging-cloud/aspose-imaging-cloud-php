<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose" file="PostImagePngRequest.php">
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
use \Aspose\Imaging\Configuration;
use \Aspose\Imaging\ObjectSerializer;
use \Aspose\Imaging\Model\Requests\ImagingRequest;

/**
 * Request model for postImagePng operation.
 */
class PostImagePngRequest extends ImagingRequest
{
    /**
     * Input image
     *
     * @var string
     */
    public $image_data;
    
    /**
     * Specifies where additional parameters we do not support should be taken from. If this is true – they will be taken from default values for standard image, if it is false – they will be saved from current image. Default is false.
     *
     * @var bool
     */
    public $from_scratch;
    
    /**
     * Path to updated file (if this is empty, response contains streamed image).
     *
     * @var string
     */
    public $out_path;
    
    /**
     * Your Aspose Cloud Storage name.
     *
     * @var string
     */
    public $storage;
    
    /**
     * Initializes a new instance of the PostImagePngRequest class.
     *  
     * @param string $image_data Input image
     * @param bool $from_scratch Specifies where additional parameters we do not support should be taken from. If this is true – they will be taken from default values for standard image, if it is false – they will be saved from current image. Default is false.
     * @param string $out_path Path to updated file (if this is empty, response contains streamed image).
     * @param string $storage Your Aspose Cloud Storage name.
     */
    public function __construct($image_data, $from_scratch = null, $out_path = null, $storage = null)             
    {
        $this->image_data = $image_data;
        $this->from_scratch = $from_scratch;
        $this->out_path = $out_path;
        $this->storage = $storage;
    }

    /**
     * Input image
     *
     * @return string
     */
    public function get_image_data()
    {
        return $this->image_data;
    }

    /**
     * Input image
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_image_data($value)
    {
        $this->image_data = $value;
        return $this;
    }
    
    /**
     * Specifies where additional parameters we do not support should be taken from. If this is true – they will be taken from default values for standard image, if it is false – they will be saved from current image. Default is false.
     *
     * @return bool
     */
    public function get_from_scratch()
    {
        return $this->from_scratch;
    }

    /**
     * Specifies where additional parameters we do not support should be taken from. If this is true – they will be taken from default values for standard image, if it is false – they will be saved from current image. Default is false.
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_from_scratch($value)
    {
        $this->from_scratch = $value;
        return $this;
    }
    
    /**
     * Path to updated file (if this is empty, response contains streamed image).
     *
     * @return string
     */
    public function get_out_path()
    {
        return $this->out_path;
    }

    /**
     * Path to updated file (if this is empty, response contains streamed image).
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_out_path($value)
    {
        $this->out_path = $value;
        return $this;
    }
    
    /**
     * Your Aspose Cloud Storage name.
     *
     * @return string
     */
    public function get_storage()
    {
        return $this->storage;
    }

    /**
     * Your Aspose Cloud Storage name.
     *
     * @return \Aspose\Imaging\Model\Requests\Request
     */
    public function set_storage($value)
    {
        $this->storage = $value;
        return $this;
    }

    /**
     * Prepares initial info for HTTP request
     *
     * @param \Aspose\Imaging\Configuration $config Imaging API configuration.
     */
    public function getHttpRequestInfo($config)
    {
        // verify the required parameter 'image_data' is set
        if ($this->image_data === null) {
            throw new \InvalidArgumentException('Missing the required parameter $image_data when calling postImagePng');
        }

        $resourcePath = '/imaging/png';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $multipart = false;
    

        // query params
        if ($this->from_scratch !== null) {
            $localName = lcfirst('fromScratch');
            $localValue = is_bool($this->from_scratch) ? ($this->from_scratch ? 'true' : 'false') : $this->from_scratch;
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
    
    
        $resourcePath = trim($resourcePath, "/") . "?" . http_build_query($queryParams);

        // form params
        if ($this->image_data !== null) {
            $multipart = true;
            $formParams[ObjectSerializer::toStandardName('image_data')] = ObjectSerializer::toFormValue($this->image_data);
        }
        // body params
        $httpBody = null;

        if ($multipart) {
            $headers['Content-Type'] = 'multipart/form-data';
        } else {
            $headers['Content-Type'] = 'application/json';
        }
        
        $httpInfo = array(
            "resourcePath" => $resourcePath,
            "queryParams" => $queryParams,
            "headerParams" => $headerParams,
            "headers" => $headers,
            "httpBody" => $httpBody,
            "multipart" => $multipart,
            "formParams" => $formParams
        );
        
        return $httpInfo;        
    }
}
